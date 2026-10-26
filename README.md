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

  private storedTransactionId = '';
  private storedAuthTxnId = '';
  private storedCavv = '';
  private storedXid = '';
  private storedDsTxnId = '';
  private storedCommerceIndicator = '';
  private storedUcafCollectionIndicator = '';
  private stepUpModalRef: NgbModalRef | null = null;
  private challengeTimeout: ReturnType<typeof setTimeout> | null = null;
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
    this.stepUpCompletionStarted = false;
    this.removeChallengeListener();
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
      () => {
        if (this.stepUpModalRef === modalRef) {
          this.stepUpModalRef = null;
        }
      }
    );

    this.challengeTimeout = setTimeout(() => {
      this.recordThreeDsNetworkEntries();
      this.reportThreeDsCallbackFailure('3ds-callback-timeout', 'Timed out waiting for the 3DS callback.');
      this.zone.run(() => this.showResultError());
    }, 5 * 60 * 1000);

    setTimeout(() => {
      if (this.stepUpModalRef) {
        this.submitStepUpForm();
      }
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
    this.challengeMessageListener = (event: MessageEvent) => {
      const frame = this.getStepUpFrame();
      if (event.origin !== window.location.origin || event.source !== frame?.contentWindow) {
        return;
      }
      const data = event.data as { type?: string; correlationId?: string } | null;
      if (data?.type !== 'cybs-3ds-return' || data.correlationId !== this.stepUpCorrelationId) {
        return;
      }
      // The return page signal is not proof of authentication. Server-side validation follows.
      this.zone.run(() => this.completeStepUpChallenge());
    };
    window.addEventListener('message', this.challengeMessageListener);
  }

  private removeStepUpMessageListener(): void {
    if (this.challengeMessageListener) {
      window.removeEventListener('message', this.challengeMessageListener);
      this.challengeMessageListener = null;
    }
  }

  onStepUpFrameLoad(): void {
    this.stepUpFrameLoadCount++;
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
      const path = frameUrl.pathname.replace(/\/+$/, '');
      this.challengeFrameAccessError = '';
      if (frameUrl.origin === window.location.origin) {
        this.lastSameOriginFramePath = path;
        // /3ds-callback must accept CyberSource's POST, persist TransactionId against
        // this payment, then serve a same-origin page that postMessages
        // { type: 'cybs-3ds-return', correlationId: MD } to the parent. The iframe
        // load is only a fallback signal; the backend must validate the persisted ID.
        if (path.endsWith('/3ds-callback')) {
          this.completeStepUpChallenge();
        }
      } else {
        this.challengeSawCrossOriginNavigation = true;
      }
    } catch (error) {
      this.challengeSawCrossOriginNavigation = true;
      this.challengeFrameAccessError = error instanceof Error
        ? `${error.name}: ${error.message}`
        : String(error);
    }
  }

  private startThreeDsDiagnostics(): void {
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
    if (this.stepUpCompletionStarted) {
      return;
    }
    this.stepUpCompletionStarted = true;
    this.removeChallengeListener();
    this.threeDsSubmitted.emit();
    this.view = 'CHECKOUT';
    this.sdkLoading = true;
    this.closeStepUpModal();
    this.storedValidate();
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

  private submitStepUpForm(): void {
    const form = document.getElementById('enbd-stepup-form') as HTMLFormElement | null;
    if (!form) {
      this.showResultError();
      return;
    }
    form.submit();
  }

  private getStepUpFrame(): HTMLIFrameElement | null {
    return document.getElementById('enbd-stepup-frame') as HTMLIFrameElement | null;
  }

  private removeChallengeListener(): void {
    this.removeStepUpMessageListener();
    if (this.challengeTimeout) {
      clearTimeout(this.challengeTimeout);
      this.challengeTimeout = null;
    }
    this.stopThreeDsDiagnostics();
  }

  private stopThreeDsDiagnostics(): void {
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
    this.http.post<any>(endpointUrl(Endpoints.CYBERSOURCE_ENBD_STORED_VALIDATE), {
      cardId: String(this.selectedCardId),
      transactionId: this.storedTransactionId,
      authenticationTransactionId: this.storedAuthTxnId
    }).subscribe({
      next: response => {
        this.storedCavv = response?.cavv || '';
        this.storedXid = response?.xid || '';
        this.storedDsTxnId = response?.directoryServerTransactionId || '';
        this.storedCommerceIndicator = response?.commerceIndicator || '';
        this.storedUcafCollectionIndicator = response?.ucafCollectionIndicator || '';
        this.storedAuthorize();
      },
      error: () => this.showResultError()
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
