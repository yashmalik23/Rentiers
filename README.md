import { HttpClient, HttpParams } from '@angular/common/http';
import { Component, ElementRef, EventEmitter, HostListener, Input, NgZone, OnDestroy, OnInit, Output, TemplateRef, ViewChild } from '@angular/core';
import { NgbModal, NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { faChevronDown, faTrashCan } from '@fortawesome/free-solid-svg-icons';

import { Account } from 'cp/src/app/models/account';
import { CyberSourceEnbdCard, Transaction } from 'cp/src/app/models/deposits';
import { dialogConfig, endpointUrl, params } from 'cp/src/app/models/common';
import { Endpoints } from 'cp/src/app/models/constants';
import { CoreService } from 'cp/src/app/services/core.service';
import { DepositService } from 'cp/src/app/services/deposit.service';
import { ModalService } from 'cp/src/app/services/modal.service';
import { DepositFormComponent } from '../deposit-form/deposit-form.component';

type View = 'FORM' | 'CHECKOUT' | 'SUCCESS' | 'PENDING' | 'ERROR';

interface ThreeDsMessage {
  type?: unknown;
  correlationId?: unknown;
  MD?: unknown;
  MessageType?: unknown;
}

interface ThreeDsNetworkDiagnostic {
  url: string;
  initiatorType: string;
  responseStatus: number | null;
  durationMs: number;
  transferSize: number;
  encodedBodySize: number;
  decodedBodySize: number;
}

@Component({
  selector: 'cp-debit-card-deposit',
  templateUrl: './debit-card-deposit.component.html',
  styleUrls: ['./debit-card-deposit.component.scss']
})
export class DebitCardDepositComponent implements OnInit, OnDestroy {

  @Input() account: Account;
  /** Optional trusted deployment URL. Set only if the 3DS return page uses another
   * origin/path. Must match the returnUrl configured on the backend; never take
   * this value from postMessage or unverified JWT claims. Default: same-origin /3ds-callback. */
  @Input() threeDsReturnUrl = '';
  @Output() completed = new EventEmitter<void>();
  /** Emitted when the issuer returns from the challenge; this is not the ACS button click itself. */
  @Output() threeDsSubmitted = new EventEmitter<void>();
  /** Emitted when the customer presses the merchant-owned Cancel button in the challenge modal. */
  @Output() threeDsCancelled = new EventEmitter<void>();
  /** Adapter hook only; the standard cross-origin ACS iframe does not expose its Resend OTP click. */
  @Output() threeDsResendOtp = new EventEmitter<void>();
  @ViewChild(DepositFormComponent) depositForm: DepositFormComponent;
  @ViewChild('cardDropdown') cardDropdown: ElementRef;
  @ViewChild('cardDeposit') cardDeposit: ElementRef<HTMLElement>;
  @ViewChild('stepUpModal', { static: true }) stepUpModal: TemplateRef<unknown>;

  readonly HEADER = 'label.deposit.uae.cards.continue';
  /** true = embedded (paymentSelection + paymentScreen); false = sidebar single container. */
  readonly useEmbeddedCheckout = true;

  currencies: string[] = ['USD'];
  cybersourceEnbdCards: CyberSourceEnbdCard[] = [];
  cardsLoading = false;
  deletingCardId: number | null = null;
  transaction: Transaction;
  view: View = 'FORM';
  sdkLoading = false;
  paymentId = '';
  deleteIcon = faTrashCan;
  chevronIcon = faChevronDown;
  dropdownOpen = false;

  selectedCardId: number | null = null;

  stepUpAccessToken = '';
  stepUpUrl = '';
  /** Random one-time value sent as CyberSource MD and echoed by the same-origin return page. */
  stepUpCorrelationId = '';
  stepUpFrameName = '';
  stepUpFormId = '';

  private storedTransactionId = '';
  private storedAuthTxnId = '';
  private storedCavv = '';
  private storedXid = '';
  private storedDsTxnId = '';
  private storedCommerceIndicator = '';
  private storedUcafCollectionIndicator = '';
  private stepUpModalRef: NgbModalRef | null = null;
  private challengeTimeout: ReturnType<typeof setTimeout> | null = null;
  private challengeSubmitTimer: ReturnType<typeof setTimeout> | null = null;
  private challengeFormSubmitted = false;
  private challengeReturnOrigin = '';
  private challengeReturnPath = '';
  private challengeProviderOrigin = '';
  private stepUpCompletionStarted = false;
  private stepUpFrameLoadCount = 0;
  private lastSameOriginFramePath = '';
  private challengeSawCrossOriginNavigation = false;
  private challengeStartedAt = 0;
  private challengePerformanceStartedAt = 0;
  private stepUpUrlForDiagnostics = '';
  private challengeFrameAccessError = '';
  private challengeBrowserErrors: string[] = [];
  private challengeNetworkEntries: ThreeDsNetworkDiagnostic[] = [];
  private challengeNetworkEntryStartTimes = new Set<number>();
  private challengeErrorListener: ((event: ErrorEvent) => void) | null = null;
  private challengeRejectionListener: ((event: PromiseRejectionEvent) => void) | null = null;
  private challengePerformanceObserver: PerformanceObserver | null = null;
  private challengeMessageListener: ((event: MessageEvent) => void) | null = null;
  private componentDestroying = false;
  private readonly threeDsDebug = new URLSearchParams(window.location.search).get('debug3ds') === '1';
  private threeDsTrace: Array<Record<string, unknown>> = [];
  private threeDsSnapshotTimer: ReturnType<typeof setTimeout> | null = null;

  private sdkScript: HTMLScriptElement | null = null;
  private checkoutClient: { destroy?: () => void } | null = null;
  private checkoutInstance: { destroy?: () => void } | null = null;
  private paymentOptionsResizeObserver: ResizeObserver | null = null;
  private scrollTimer: ReturnType<typeof setTimeout> | null = null;

  constructor(
    private core: CoreService,
    private depositService: DepositService,
    private modal: ModalService,
    private ngbModal: NgbModal,
    private http: HttpClient,
    private zone: NgZone
  ) {
    if (this.core.getFromBaseModel('baseModel.countryOfResidence.isoCode') === 'AE') {
      this.currencies.push('AED');
    }
  }

  ngOnInit(): void {
    this.fetchCybersourceEnbdCards();
  }

  ngOnDestroy(): void {
    this.componentDestroying = true;
    if (this.scrollTimer) {
      clearTimeout(this.scrollTimer);
      this.scrollTimer = null;
    }
    this.destroyCheckout();
    this.removeSdkScript();
    this.removeChallengeListener();
    this.dismissStepUpModal();
  }

  get selectedCard(): CyberSourceEnbdCard | null {
    return this.cybersourceEnbdCards.find(c => c.id === this.selectedCardId) ?? null;
  }

  @HostListener('document:click', ['$event'])
  onDocumentClick(event: MouseEvent): void {
    if (this.dropdownOpen && this.cardDropdown && !this.cardDropdown.nativeElement.contains(event.target)) {
      this.dropdownOpen = false;
    }
  }

  toggleDropdown(): void {
    this.dropdownOpen = !this.dropdownOpen;
  }

  selectCard(card: CyberSourceEnbdCard | null): void {
    this.selectedCardId = card?.id ?? null;
    this.dropdownOpen = false;
  }

  onContinue(): void {
    this.depositForm?.onSubmit();
  }

  get canContinue(): boolean {
    return !!this.depositForm?.canSubmit;
  }

  cardBrandIcon(card: CyberSourceEnbdCard): string {
    const type = (card.cardType || '').toLowerCase();
    if (type.includes('visa')) {
      return 'assets/img/deposits/deposit-drop-visa.png';
    }
    if (type.includes('master')) {
      return 'assets/img/deposits/deposit-drop-mastercard.png';
    }
    return 'assets/img/deposits/deposit-drop-other.png';
  }

  deleteCreditCardConfirm(card: CyberSourceEnbdCard): void {
    if (this.deletingCardId !== null) {
      return;
    }
    const config: dialogConfig = {
      headerClass: 'text-capitalize',
      okBtnCaption: 'label.credit.card.delete.button',
      cancelBtn: true,
      cancelBtnCaption: 'label.cancel'
    };
    this.modal.showInfo('label.credit.card.delete.confirm', 'label.credit.card.delete.button', config)
      .then(() => this.deleteCybersourceEnbdCard(card.id));
  }

  private fetchCybersourceEnbdCards(): void {
    this.cardsLoading = true;
    this.depositService.cybersourceEnbdCards().subscribe({
      next: cards => {
        this.cybersourceEnbdCards = cards;
        this.selectedCardId = cards.find(c => c.isDefaultCard)?.id ?? cards[0]?.id ?? null;
        this.cardsLoading = false;
      },
      error: response => {
        this.cardsLoading = false;
        this.modal.showErrorResponse(response, undefined, this.HEADER);
      }
    });
  }

  private deleteCybersourceEnbdCard(cardId: number): void {
    this.deletingCardId = cardId;
    this.depositService.deleteCybersourceEnbdCard(cardId).subscribe({
      next: response => {
        this.deletingCardId = null;
        if (!response?.success) {
          this.modal.showError('label.error.unexpected', 'label.credit.card.delete.button');
          return;
        }
        if (this.selectedCardId === cardId) {
          this.selectedCardId = null;
        }
        this.fetchCybersourceEnbdCards();
        this.modal.showInfo('label.operation.completed.successfully', 'label.success', {icon: 'success'});
      },
      error: response => {
        this.deletingCardId = null;
        this.modal.showErrorResponse(response, undefined, 'llabel.credit.card.delete.button');
      }
    });
  }

  startTransaction(dto: Transaction): void {
    this.modal.showProcessing();
    // Preferred debit rail; BE may remap to CREDIT_CARD_NG when ENBD_DEBIT_CARDS is off
    Object.assign(dto, { provider: 'ENBD_CARD' });
    if (this.selectedCardId !== null) {
      // Signal to EnbdDepositHandler to skip Unified Checkout session and run setup+enroll inline instead
      dto.cybersourceEnbd = { ...(dto.cybersourceEnbd || {}), cardId: this.selectedCardId, browserFields: this.collectBrowserFields() };
    }
    this.depositService.startTransaction(dto).subscribe({
      next: response => {
        this.modal.hideProcessing();
        if (response.success) {
          this.transaction = response;
          this.showCbuaePopup()
            .then(() => this.runExecuteTransaction())
            .catch(() => undefined);
        } else {
          this.modal.showError(response.message, this.HEADER);
        }
      },
      error: response => this.modal.showErrorResponse(response, undefined, this.HEADER)
    });
  }

  private showCbuaePopup(): Promise<void> {
    const popupConfig: dialogConfig = {
      icon: 'alert-circle',
      iconSizePx: 36,
      okBtnCaption: 'label.modal.ok',
      okBtnSuccess: true,
      cancelBtn: false,
      closeBtn: false,
      escape: true,
      dismissable: true,
      windowClass: 'info deposit-cbuae-popup',
      bodyTextSmall: 'label.deposit.cbuae.popup.note'
    };
    return this.modal.showInfo(
      'label.deposit.cbuae.popup.body',
      'label.deposit.cbuae.popup.title',
      popupConfig
    );
  }

  private runExecuteTransaction(): void {
    this.modal.showProcessing();
    this.depositService.executeTransaction(this.transaction).subscribe({
      next: response => {
        this.modal.hideProcessing();
        if (!response.success) {
          this.modal.showError(response.message, this.HEADER);
          return;
        }
        this.transaction = response;
        if (this.selectedCardId !== null && response.transactionId) {
          this.handleStoredCardExecuteResponse(response);
        } else if (response.provider === 'ENBD_CARD'
            || response.cybersourceEnbd?.captureContextJwt) {
          this.openEnbdCheckout(response);
        } else {
          this.assignToHostedPage(response);
        }
      },
      error: response => this.modal.showErrorResponse(response, undefined, this.HEADER)
    });
  }

  private openEnbdCheckout(transaction: Transaction): void {
    if (!transaction.cybersourceEnbd?.captureContextJwt || !transaction.cybersourceEnbd?.clientLibrary) {
      this.modal.showError(transaction.message || 'label.error.unexpected', this.HEADER);
      return;
    }
    this.view = 'CHECKOUT';
    this.scrollStepIntoView();
    this.sdkLoading = true;
    this.loadSdk(transaction.cybersourceEnbd.clientLibrary, transaction.cybersourceEnbd.captureContextJwt);
  }

  // ---------------------------------------------------------------------------
  // Stored-card repeat-payment flow (AFT + 3DS + DM).
  // Setup + enrollment ran inside executeTransaction(); challenged and pending enrollments
  // continue through validate, while successful authentication can authorize immediately.
  // ---------------------------------------------------------------------------

  private handleStoredCardExecuteResponse(response: Transaction): void {
    this.storedTransactionId = response.transactionId!;
    this.storedAuthTxnId = response.cybersourceEnbd?.authenticationTransactionId || '';

    if (response.cybersourceEnbd?.enrollStatus === 'AUTHENTICATION_SUCCESSFUL') {
      this.storedCavv = response.cybersourceEnbd.cavv || '';
      this.storedXid = response.cybersourceEnbd.xid || '';
      this.storedDsTxnId = response.cybersourceEnbd.directoryServerTransactionId || '';
      this.storedCommerceIndicator = response.cybersourceEnbd.commerceIndicator || '';
      this.storedUcafCollectionIndicator = response.cybersourceEnbd.ucafCollectionIndicator || '';
      this.view = 'CHECKOUT';
      this.sdkLoading = true;
      this.storedAuthorize();
      return;
    }

    const stepUpUrl = response.cybersourceEnbd?.stepUpUrl;
    const accessToken = response.cybersourceEnbd?.accessToken;

    if (response.cybersourceEnbd?.challengeRequired === 'Y' && stepUpUrl && accessToken) {
      this.showChallenge(stepUpUrl, accessToken);
    } else {
      this.view = 'CHECKOUT';
      this.sdkLoading = true;
      this.storedValidate();
    }
  }

  private showChallenge(stepUpUrl: string, accessToken: string): void {
    // Retire the previous attempt before setting up new timers or accepting messages.
    this.removeChallengeListener();
    this.closeStepUpModal();
    this.sdkLoading = false;
    if (!this.isHttpsStepUpUrl(stepUpUrl) || !accessToken) {
      this.showResultError();
      return;
    }
    // Bind the HTTPS URL normally so Angular's URL sanitizer remains active.
    this.stepUpUrl = stepUpUrl;
    this.stepUpUrlForDiagnostics = this.sanitizeDiagnosticUrl(stepUpUrl);
    this.stepUpAccessToken = accessToken;
    this.stepUpCorrelationId = this.createStepUpCorrelationId();
    this.stepUpFrameName = `enbd-stepup-${this.stepUpCorrelationId}`;
    this.stepUpFormId = `${this.stepUpFrameName}-form`;
    this.challengeFormSubmitted = false;
    try {
      const returnUrl = new URL(this.threeDsReturnUrl || '/3ds-callback', window.location.origin);
      if (returnUrl.protocol !== 'https:' || returnUrl.username || returnUrl.password) {
        throw new Error('The 3DS return URL must be a trusted HTTPS URL.');
      }
      this.challengeReturnOrigin = returnUrl.origin;
      // Preserve the existing /prefix/3ds-callback fallback unless deployment
      // configuration supplies an exact return URL.
      this.challengeReturnPath = this.threeDsReturnUrl
        ? returnUrl.pathname.replace(/\/+$/, '') || '/' : '';
      this.challengeProviderOrigin = new URL(stepUpUrl).origin;
    } catch {
      this.showResultError();
      return;
    }
    this.stepUpCompletionStarted = false;
    this.stepUpFrameLoadCount = 0;
    this.lastSameOriginFramePath = '';
    this.challengeSawCrossOriginNavigation = false;
    this.challengeStartedAt = Date.now();
    this.challengePerformanceStartedAt = performance.now();
    this.challengeFrameAccessError = '';
    this.challengeBrowserErrors = [];
    this.challengeNetworkEntries = [];
    this.challengeNetworkEntryStartTimes = new Set<number>();
    this.startThreeDsDiagnostics();
    this.startStepUpMessageListener();
    this.stepUpModalRef = this.ngbModal.open(this.stepUpModal, {
      size: 'xl',
      centered: true,
      // The customer can exit only through the issuer's in-iframe challenge controls.
      backdrop: 'static',
      keyboard: false,
      windowClass: 'cs-enbd-stepup-window'
    });
    const modalRef = this.stepUpModalRef;
    modalRef.result.then(
      () => {
        if (this.stepUpModalRef === modalRef) {
          this.stepUpModalRef = null;
        }
      },
      reason => {
        if (this.stepUpModalRef === modalRef) {
          this.stepUpModalRef = null;
          if (!this.componentDestroying) {
            this.handleStepUpModalDismiss();
          }
        }
      }
    );

    const attempt = this.stepUpCorrelationId;
    // A timeout only exits a stalled challenge; it never validates or authorizes.
    this.zone.runOutsideAngular(() => {
      this.challengeTimeout = setTimeout(() => {
        if (!this.isActiveStepUpAttempt(attempt)) return;
        try {
          this.recordThreeDsNetworkEntries();
          this.reportThreeDsCallbackFailure('3ds-callback-timeout', 'Timed out waiting for the 3DS callback.');
        } catch (error) {
          console.warn('[3DS] Timeout diagnostic failed', error);
        } finally {
          this.zone.run(() => this.showResultError());
        }
      }, 5 * 60 * 1000);
    });

    this.challengeSubmitTimer = setTimeout(() => {
      this.challengeSubmitTimer = null;
      if (this.isActiveStepUpAttempt(attempt)) this.submitStepUpForm();
    });
  }

  private createStepUpCorrelationId(): string {
    const bytes = new Uint8Array(16);
    if (window.crypto?.getRandomValues) {
      window.crypto.getRandomValues(bytes);
      return Array.from(bytes, value => value.toString(16).padStart(2, '0')).join('');
    }
    // Correlation only, not authentication. Supports older embedded mobile browsers.
    return `${Date.now().toString(36)}-${Math.random().toString(36).slice(2)}`;
  }

  private startStepUpMessageListener(): void {
    this.removeStepUpMessageListener();
    const attempt = this.stepUpCorrelationId;
    this.challengeMessageListener = (event: MessageEvent) => {
      if (!this.isActiveStepUpAttempt(attempt) || !this.challengeFormSubmitted) return;
      const frame = this.getStepUpFrame();
      const sourceMatches = !!frame?.contentWindow && event.source === frame.contentWindow;
      const data = this.parseStepUpMessage(event.data);
      if (!data) return;
      const correlation = data.correlationId ?? data.MD;
      const correlationPresent = correlation !== undefined && correlation !== null;
      const correlationMatches = correlation === attempt;
      const returnOriginMatches = event.origin === this.challengeReturnOrigin;
      if (sourceMatches || data.type === 'cybs-3ds-return' || data.type === '3DS_COMPLETE') {
        this.traceThreeDs('callback-message', {
          type: data.type, origin: event.origin, sourceMatches,
          originMatches: returnOriginMatches, correlationPresent, correlationMatches
        });
      }
      if (!sourceMatches) return;
      if (correlationPresent && !correlationMatches) return;

      // Modern return page: MD must correlate to this attempt. Legacy POC return
      // pages use 3DS_COMPLETE without MD; accept only from the active frame and
      // the configured return origin. Neither message means payment success.
      const correlatedReturn = returnOriginMatches && data.type === 'cybs-3ds-return' && correlationMatches;
      const legacyReturn = returnOriginMatches && data.type === '3DS_COMPLETE';
      const providerReturn = event.origin === this.challengeProviderOrigin &&
        data.MessageType === 'stepUp.completion';
      if (correlatedReturn || legacyReturn || providerReturn) this.completeStepUpChallenge();
    };
    window.addEventListener('message', this.challengeMessageListener);
  }

  private parseStepUpMessage(value: unknown): ThreeDsMessage | null {
    try {
      const data = typeof value === 'string' ? JSON.parse(value) : value;
      return data && typeof data === 'object' && !Array.isArray(data)
        ? data as ThreeDsMessage : null;
    } catch {
      return null;
    }
  }

  private isActiveStepUpAttempt(attempt: string): boolean {
    return !this.componentDestroying && !!this.stepUpModalRef &&
      !this.stepUpCompletionStarted && !!attempt && this.stepUpCorrelationId === attempt;
  }

  private removeStepUpMessageListener(): void {
    if (this.challengeMessageListener) {
      window.removeEventListener('message', this.challengeMessageListener);
      this.challengeMessageListener = null;
    }
  }

  onStepUpFrameLoad(): void {
    if (!this.isActiveStepUpAttempt(this.stepUpCorrelationId)) return;
    this.stepUpFrameLoadCount++;
    const frame = this.getStepUpFrame();
    this.traceThreeDs('iframe-load', { count: this.stepUpFrameLoadCount, connected: frame?.isConnected });
    this.checkStepUpReturn();
  }

  private checkStepUpReturn(): void {
    if (!this.isActiveStepUpAttempt(this.stepUpCorrelationId) || !this.challengeFormSubmitted) return;
    const frame = this.getStepUpFrame();
    if (!frame?.contentWindow) {
      this.challengeFrameAccessError = 'Step-up iframe or contentWindow is unavailable.';
      return;
    }
    try {
      const frameUrl = new URL(frame.contentWindow.location.href);
      if (frameUrl.protocol === 'about:') {
        return;
      }
      const path = frameUrl.pathname.replace(/\/+$/, '') || '/';
      if (path !== this.lastSameOriginFramePath) {
        this.traceThreeDs('iframe-readable', { url: this.sanitizeDiagnosticUrl(frameUrl.href) });
      }
      this.challengeFrameAccessError = '';
      if (frameUrl.origin === window.location.origin) {
        this.lastSameOriginFramePath = path;
        // The iframe load event supplements postMessage. This only detects return;
        // the existing validation endpoint still determines the 3DS result.
        const callbackPathMatches = this.challengeReturnPath
          ? path === this.challengeReturnPath : path.endsWith('/3ds-callback');
        if (frameUrl.origin === this.challengeReturnOrigin && callbackPathMatches) {
          this.completeStepUpChallenge();
        }
      } else {
        this.challengeSawCrossOriginNavigation = true;
      }
    } catch (error) {
      // Cross-origin access is expected while the issuer owns the frame.
      if (!this.challengeFrameAccessError) {
        this.traceThreeDs('iframe-unreadable', {
          errorName: error instanceof Error ? error.name : 'Unknown'
        });
      }
      this.challengeSawCrossOriginNavigation = true;
      this.challengeFrameAccessError = error instanceof Error
        ? `${error.name}: ${error.message}`
        : String(error);
    }
  }

  private startThreeDsDiagnostics(): void {
    this.threeDsTrace = [];
    this.traceThreeDs('challenge-start', {
      userAgent: navigator.userAgent,
      online: navigator.onLine,
      secureContext: window.isSecureContext,
      pageOrigin: window.location.origin,
      expectedReturnOrigin: this.challengeReturnOrigin,
      expectedReturnPath: this.challengeReturnPath || '*/3ds-callback',
      viewport: `${window.innerWidth}x${window.innerHeight}`
    });
    if (this.threeDsDebug) {
      this.threeDsSnapshotTimer = setTimeout(() => {
        if (this.stepUpModalRef && !this.stepUpCompletionStarted) {
          this.traceThreeDs('pending-at-60s');
          this.recordThreeDsNetworkEntries();
          this.reportThreeDsCallbackFailure('3ds-debug-pending', 'Diagnostic snapshot; not a final authentication result.');
        }
      }, 60_000);
    }
    this.challengeErrorListener = event => {
      this.challengeBrowserErrors.push(JSON.stringify({
        type: 'window.error',
        message: event.message,
        filename: this.sanitizeDiagnosticUrl(event.filename),
        line: event.lineno,
        column: event.colno,
        stack: event.error instanceof Error ? event.error.stack : undefined
      }).slice(0, 3000));
      this.challengeBrowserErrors = this.challengeBrowserErrors.slice(-10);
    };
    this.challengeRejectionListener = event => {
      const reason = event.reason;
      this.challengeBrowserErrors.push(JSON.stringify({
        type: 'unhandledrejection',
        message: reason instanceof Error ? reason.message : String(reason),
        stack: reason instanceof Error ? reason.stack : undefined
      }).slice(0, 3000));
      this.challengeBrowserErrors = this.challengeBrowserErrors.slice(-10);
    };
    window.addEventListener('error', this.challengeErrorListener);
    window.addEventListener('unhandledrejection', this.challengeRejectionListener);

    if (typeof PerformanceObserver !== 'undefined') {
      try {
        this.challengePerformanceObserver = new PerformanceObserver(list => {
          this.addThreeDsNetworkEntries(list.getEntries());
        });
        this.challengePerformanceObserver.observe({ entryTypes: ['resource'] });
      } catch (error) {
        this.challengeBrowserErrors.push(`PerformanceObserver unavailable: ${error instanceof Error ? error.message : String(error)}`);
      }
    }
  }

  private addThreeDsNetworkEntries(entries: PerformanceEntry[]): void {
    for (const entry of entries) {
      if (entry.entryType !== 'resource') {
        continue;
      }
      const url = this.sanitizeDiagnosticUrl(entry.name);
      if (!url.toLowerCase().includes('3ds-callback')
          || entry.startTime < this.challengePerformanceStartedAt
          || this.challengeNetworkEntryStartTimes.has(entry.startTime)) {
        continue;
      }
      this.challengeNetworkEntryStartTimes.add(entry.startTime);
      const resource = entry as PerformanceResourceTiming & { responseStatus?: number };
      this.challengeNetworkEntries.push({
        url,
        initiatorType: resource.initiatorType,
        responseStatus: typeof resource.responseStatus === 'number' ? resource.responseStatus : null,
        durationMs: Math.round(resource.duration),
        transferSize: resource.transferSize,
        encodedBodySize: resource.encodedBodySize,
        decodedBodySize: resource.decodedBodySize
      });
    }
    this.challengeNetworkEntries = this.challengeNetworkEntries.slice(-10);
  }

  private recordThreeDsNetworkEntries(): void {
    this.addThreeDsNetworkEntries(performance.getEntriesByType('resource'));
  }

  private sanitizeDiagnosticUrl(value: string): string {
    try {
      const url = new URL(value, window.location.origin);
      return `${url.origin}${url.pathname}`;
    } catch {
      return value.split(/[?#]/, 1)[0];
    }
  }

  private reportThreeDsCallbackFailure(source: string, message: string): void {
    const diagnosticLog = {
      source,
      elapsedMs: Date.now() - this.challengeStartedAt,
      transactionId: this.storedTransactionId,
      authenticationTransactionId: this.storedAuthTxnId,
      enrollStatus: this.transaction?.cybersourceEnbd?.enrollStatus || '',
      challengeRequired: this.transaction?.cybersourceEnbd?.challengeRequired || '',
      stepUpUrl: this.stepUpUrlForDiagnostics,
      iframeLoadCount: this.stepUpFrameLoadCount,
      challengeSawCrossOriginNavigation: this.challengeSawCrossOriginNavigation,
      lastSameOriginFramePath: this.lastSameOriginFramePath || 'unavailable',
      iframeAccessError: this.challengeFrameAccessError || 'none',
      browserErrors: this.challengeBrowserErrors,
      debugTrace: this.threeDsTrace,
      callbackNetworkEntries: this.challengeNetworkEntries,
      browser: {
        userAgent: navigator.userAgent,
        platform: navigator.platform,
        language: navigator.language,
        online: navigator.onLine,
        screen: `${window.screen.width}x${window.screen.height}`,
        viewport: `${window.innerWidth}x${window.innerHeight}`
      },
      limitations: 'Iframe navigation response body and POST data are not readable by the parent page. Network response status is included only when exposed by Resource Timing.'
    };
    const stackTrace = JSON.stringify(diagnosticLog);
    this.http.post(endpointUrl(Endpoints.ERROR_LOG), {
      message: `${message} | ${source}`,
      stackTrace,
      userAgent: navigator.userAgent,
      url: `${window.location.origin}${window.location.pathname}`,
    }).subscribe({
      error: error => console.error('Failed to send 3DS callback diagnostic', error)
    });
  }

  private completeStepUpChallenge(): void {
    if (!this.isActiveStepUpAttempt(this.stepUpCorrelationId) || !this.challengeFormSubmitted) return;
    // Claim completion before diagnostics or callbacks so load and message
    // events cannot submit validation/authorization more than once.
    this.stepUpCompletionStarted = true;
    this.zone.run(() => {
      this.traceThreeDs('callback-accepted');
      if (this.threeDsDebug) {
        try {
          this.reportThreeDsCallbackFailure('3ds-debug-return', 'Diagnostic snapshot; challenge returned.');
        } catch (error) {
          console.warn('[3DS] Completion diagnostic failed', error);
        }
      }
      this.removeChallengeListener();
      this.view = 'CHECKOUT';
      this.sdkLoading = true;
      this.closeStepUpModal();
      this.threeDsSubmitted.emit();
      if (!this.componentDestroying && this.view === 'CHECKOUT') this.storedValidate();
    });
  }

  private handleStepUpModalDismiss(): void {
    if (this.stepUpCompletionStarted) {
      return;
    }
    this.stepUpCompletionStarted = true;
    this.removeChallengeListener();
    this.stepUpUrl = '';
    this.stepUpAccessToken = '';
    this.stepUpCorrelationId = '';
    this.sdkLoading = false;
    this.view = 'FORM';
    this.threeDsCancelled.emit();
  }

  /** Close the modal and notify the host; cancel any pending attempt server-side from the listener if required. */
  cancelStepUpChallenge(): void {
    if (!this.stepUpModalRef || this.stepUpCompletionStarted) {
      return;
    }
    this.stepUpCompletionStarted = true;
    this.removeChallengeListener();
    this.closeStepUpModal();
    this.backToForm();
    this.threeDsCancelled.emit();
  }

  /** Call only from a provider-specific event if your 3DS integration exposes OTP resend. */
  notifyThreeDsResendOtp(): void {
    this.threeDsResendOtp.emit();
  }

  private isHttpsStepUpUrl(value: string): boolean {
    try {
      return new URL(value).protocol === 'https:';
    } catch {
      return false;
    }
  }

  private traceThreeDs(stage: string, details: Record<string, unknown> = {}): void {
    if (!this.threeDsDebug) return;
    const entry = { stage, elapsedMs: Date.now() - this.challengeStartedAt, ...details };
    this.threeDsTrace.push(entry);
    this.threeDsTrace = this.threeDsTrace.slice(-40);
    console.info('[3DS]', entry);
  }

  // Diagnostic decoding only; never trust these claims as authentication proof.
  private stepUpJwtMetadata(token: string): Record<string, unknown> {
    try {
      const part = token.split('.')[1].replace(/-/g, '+').replace(/_/g, '/');
      const claims = JSON.parse(atob(part.padEnd(Math.ceil(part.length / 4) * 4, '=')));
      const payload = claims.Payload && typeof claims.Payload === 'object' ? claims.Payload : {};
      const returnUrl = claims.ReturnUrl ?? claims.ReturnURL ?? payload.ReturnUrl ?? payload.ReturnURL;
      return {
        decoded: true,
        returnUrlFound: typeof returnUrl === 'string' && returnUrl.length > 0,
        returnUrl: typeof returnUrl === 'string' && returnUrl
          ? this.sanitizeDiagnosticUrl(returnUrl) : null,
        expiresInSeconds: typeof claims.exp === 'number'
          ? Math.floor(claims.exp - Date.now() / 1000) : null
      };
    } catch {
      return { decoded: false };
    }
  }

  private submitStepUpForm(): void {
    const attempt = this.stepUpCorrelationId;
    if (!this.isActiveStepUpAttempt(attempt) || this.challengeFormSubmitted) return;
    const frame = this.getStepUpFrame();
    if (!frame?.isConnected) {
      this.showResultError();
      return;
    }
    try {
      // Submit from the initial same-origin iframe document. A parent form with
      // a dynamic named target can open a tab if that browsing context is not
      // resolved. _self here always navigates this existing modal iframe.
      const frameDocument = frame.contentDocument;
      if (!frameDocument?.body || !frame.contentWindow) {
        this.showResultError();
        return;
      }
      const form = frameDocument.createElement('form');
      form.id = this.stepUpFormId;
      form.method = 'POST';
      form.action = this.stepUpUrl;
      form.target = '_self';
      form.hidden = true;
      for (const [name, value] of [['JWT', this.stepUpAccessToken], ['MD', attempt]]) {
        const input = frameDocument.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        form.appendChild(input);
      }
      frameDocument.body.appendChild(form);
      this.traceThreeDs('step-up-post', {
        action: this.sanitizeDiagnosticUrl(form.action),
        method: form.method,
        target: form.target,
        formInsideFrame: form.ownerDocument === frameDocument,
        frameConnected: frame.isConnected,
        sandbox: frame.getAttribute('sandbox'),
        jwtMetadata: this.stepUpJwtMetadata(this.stepUpAccessToken)
      });
      this.challengeFormSubmitted = true;
      HTMLFormElement.prototype.submit.call(form);
    } catch {
      this.showResultError();
    }
  }

  private getStepUpFrame(): HTMLIFrameElement | null {
    return this.stepUpFrameName
      ? document.getElementById(this.stepUpFrameName) as HTMLIFrameElement | null : null;
  }

  private removeChallengeListener(): void {
    this.removeStepUpMessageListener();
    if (this.challengeSubmitTimer !== null) {
      clearTimeout(this.challengeSubmitTimer);
      this.challengeSubmitTimer = null;
    }
    this.challengeFormSubmitted = false;
    if (this.challengeTimeout) {
      clearTimeout(this.challengeTimeout);
      this.challengeTimeout = null;
    }
    this.stopThreeDsDiagnostics();
  }

  private stopThreeDsDiagnostics(): void {
    if (this.threeDsSnapshotTimer) {
      clearTimeout(this.threeDsSnapshotTimer);
      this.threeDsSnapshotTimer = null;
    }
    if (this.challengeErrorListener) {
      window.removeEventListener('error', this.challengeErrorListener);
      this.challengeErrorListener = null;
    }
    if (this.challengeRejectionListener) {
      window.removeEventListener('unhandledrejection', this.challengeRejectionListener);
      this.challengeRejectionListener = null;
    }
    this.challengePerformanceObserver?.disconnect();
    this.challengePerformanceObserver = null;
  }

  private dismissStepUpModal(): void {
    if (this.stepUpModalRef) {
      this.stepUpModalRef.dismiss();
      this.stepUpModalRef = null;
    }
  }

  private closeStepUpModal(): void {
    if (this.stepUpModalRef) {
      this.stepUpModalRef.close();
      this.stepUpModalRef = null;
    }
    this.stepUpUrl = '';
    this.stepUpAccessToken = '';
    this.stepUpCorrelationId = '';
  }

  private storedValidate(): void {
    this.traceThreeDs('stored-validation-start');
    this.http.post<any>(endpointUrl(Endpoints.CYBERSOURCE_ENBD_STORED_VALIDATE), {
      cardId: String(this.selectedCardId),
      transactionId: this.storedTransactionId,
      authenticationTransactionId: this.storedAuthTxnId
    }).subscribe({
      next: response => {
        this.traceThreeDs('stored-validation-response', {
          success: response?.success,
          status: response?.status,
          authenticationStatus: response?.authenticationStatus,
          cavvPresent: !!response?.cavv
        });
        if (response?.success === false) {
          this.showResultError();
          return;
        }
        this.storedCavv = response?.cavv || '';
        this.storedXid = response?.xid || '';
        this.storedDsTxnId = response?.directoryServerTransactionId || '';
        this.storedCommerceIndicator = response?.commerceIndicator || '';
        this.storedUcafCollectionIndicator = response?.ucafCollectionIndicator || '';
        this.storedAuthorize();
      },
      error: response => {
        this.traceThreeDs('stored-validation-http-error', { status: response?.status });
        if (this.threeDsDebug) {
          this.reportThreeDsCallbackFailure('3ds-debug-validation', 'Validation request failed.');
        }
        this.showResultError();
      }
    });
  }

  private storedAuthorize(): void {
    this.http.post<any>(endpointUrl(Endpoints.CYBERSOURCE_ENBD_STORED_AUTHORIZE), {
      cardId: String(this.selectedCardId),
      transactionId: this.storedTransactionId,
      cavv: this.storedCavv,
      xid: this.storedXid,
      directoryServerTransactionId: this.storedDsTxnId,
      commerceIndicator: this.storedCommerceIndicator,
      ucafCollectionIndicator: this.storedUcafCollectionIndicator
    }).subscribe({
      next: response => {
        this.sdkLoading = false;
        this.paymentId = response?.id || '';
        this.view = response?.success ? 'SUCCESS' : 'ERROR';
        this.closeStepUpModal();
      },
      error: () => this.showResultError()
    });
  }

  private collectBrowserFields(): Record<string, string> {
    return {
      browserScreenWidth:  String(window.screen.width),
      browserScreenHeight: String(window.screen.height),
      browserColorDepth:   String(window.screen.colorDepth),
      browserLanguage:     navigator.language || 'en-US',
      browserUserAgent:    navigator.userAgent,
      browserJavaEnabled:  String(typeof (navigator as any).javaEnabled === 'function' && (navigator as any).javaEnabled()),
      browserAcceptHeader: 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
      browserAcceptContent: 'all',
      browserJavascriptEnabled: 'true',
      browserTZ:           String(new Date().getTimezoneOffset())
    };
  }

  private assignToHostedPage(transaction: Transaction): void {
    const httpParams: HttpParams = params(transaction.targetData);
    const paramsPrefix: string = transaction.targetUrl?.includes('?') ? '&' : '?';
    window.location.assign(`${transaction.targetUrl}${paramsPrefix}${httpParams.toString()}`);
  }

  private loadSdk(clientLibraryUrl: string, captureContextJwt: string): void {
    this.removeSdkScript();
    const script = document.createElement('script');
    script.src = clientLibraryUrl;
    script.crossOrigin = 'anonymous';
    script.onload = () => this.waitForVAS()
      .then(() => this.initPayment(captureContextJwt))
      .catch(() => this.showResultError());
    script.onerror = () => this.showResultError();
    document.head.appendChild(script);
    this.sdkScript = script;
  }

  private waitForVAS(): Promise<void> {
    return new Promise((resolve, reject) => {
      let attempts = 0;
      const id = setInterval(() => {
        const w = window as any;
        if (typeof w.VAS !== 'undefined' && typeof w.VAS.UnifiedCheckout === 'function') {
          clearInterval(id);
          resolve();
        } else if (++attempts > 60) {
          clearInterval(id);
          reject(new Error('Payment SDK did not load in time. Please try again.'));
        }
      }, 100);
    });
  }

  private async initPayment(captureContextJwt: string): Promise<void> {
    try {
      const w = window as any;
      const client = await w.VAS.UnifiedCheckout(captureContextJwt);
      const checkout = await client.createCheckout({ autoProcessing: true });
      this.checkoutClient = client;
      this.checkoutInstance = checkout;
      this.watchPaymentOptionsRendered();
      const mountTarget = this.useEmbeddedCheckout
        ? {
            paymentSelection: '#cs-enbd-payment-selection',
            paymentScreen: '#cs-enbd-payment-screen'
          }
        : '#cs-enbd-payment-container';
      const resultJwt = await checkout.mount(mountTarget);
      if (resultJwt) {
        this.authorizePayment(resultJwt);
      } else {
        this.showResultError();
      }
    } catch {
      this.showResultError();
    }
  }

  private authorizePayment(transientToken: string): void {
    this.clearCheckoutMount();
    this.stopPaymentOptionsWatch();
    this.sdkLoading = true;
    this.http.post<any>(endpointUrl(Endpoints.CYBERSOURCE_ENBD_AUTHORIZE), {
      transientToken
    }).subscribe({
      next: response => {
        this.sdkLoading = false;
        this.paymentId = response?.paymentId || '';
        this.view = this.resultViewFromAuthorize(response);
        this.destroyCheckout();
      },
      error: () => this.showResultError()
    });
  }

  backToForm(): void {
    this.view = 'FORM';
    this.paymentId = '';
    this.destroyCheckout();
    this.removeSdkScript();
    this.removeChallengeListener();
    this.dismissStepUpModal();
    this.stepUpUrl = '';
    this.stepUpAccessToken = '';
    this.stepUpCorrelationId = '';
  }

  onDone(): void {
    this.completed.emit();
  }

  private resultViewFromAuthorize(response: any): View {
    const psp = String(response?.pspStatus || '').toUpperCase();
    const status = String(response?.paymentStatus || '').toUpperCase();
    if (psp === 'PENDING' || status === 'PENDING_AT_PROVIDER') {
      return 'PENDING';
    }
    if (status === 'ACCEPTED' || psp === 'AUTHORIZED') {
      return 'SUCCESS';
    }
    return 'ERROR';
  }

  private showResultError(): void {
    this.sdkLoading = false;
    this.view = 'ERROR';
    this.destroyCheckout();
    this.removeChallengeListener();
    this.closeStepUpModal();
  }

  private scrollStepIntoView(): void {
    if (this.scrollTimer) {
      clearTimeout(this.scrollTimer);
    }
    this.scrollTimer = setTimeout(() => {
      this.scrollTimer = null;
      this.alignCardDeposit();
      requestAnimationFrame(() => this.alignCardDeposit());
    });
  }

  private alignCardDeposit(): void {
    const el = this.cardDeposit?.nativeElement;
    if (!el) {
      return;
    }
    const offset = el.getBoundingClientRect().top;
    if (offset >= 0) {
      return;
    }
    const top = Math.max(0, window.scrollY + offset - 24);
    window.scrollTo(0, top);
    document.documentElement.scrollTop = top;
    document.body.scrollTop = top;
  }

  private watchPaymentOptionsRendered(): void {
    this.stopPaymentOptionsWatch();
    const rootId = this.useEmbeddedCheckout ? 'cs-enbd-payment-selection' : 'cs-enbd-payment-container';
    const root = document.getElementById(rootId);
    if (!root) {
      return;
    }
    // Empty iframe is inserted before Card/GPay paint. Hide once that box has button height.
    this.paymentOptionsResizeObserver = new ResizeObserver(() => {
      if (this.view !== 'CHECKOUT' || root.getBoundingClientRect().height < 48) {
        return;
      }
      this.stopPaymentOptionsWatch();
      this.zone.run(() => {
        if (this.view === 'CHECKOUT') {
          this.sdkLoading = false;
        }
      });
    });
    this.paymentOptionsResizeObserver.observe(root);
  }

  private stopPaymentOptionsWatch(): void {
    this.paymentOptionsResizeObserver?.disconnect();
    this.paymentOptionsResizeObserver = null;
  }

  private clearCheckoutMount(): void {
    ['cs-enbd-payment-container', 'cs-enbd-payment-selection', 'cs-enbd-payment-screen']
      .forEach(id => {
        const el = document.getElementById(id);
        if (el) {
          el.innerHTML = '';
        }
      });
  }

  private destroyCheckout(): void {
    this.stopPaymentOptionsWatch();
    try {
      this.checkoutInstance?.destroy?.();
      this.checkoutClient?.destroy?.();
    } catch {
      // SDK may already be torn down
    }
    this.checkoutInstance = null;
    this.checkoutClient = null;
    this.clearCheckoutMount();
  }

  private removeSdkScript(): void {
    if (this.sdkScript) {
      this.sdkScript.remove();
      this.sdkScript = null;
    }
  }
}
