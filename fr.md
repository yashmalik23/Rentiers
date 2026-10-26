<div class="card-deposit" #cardDeposit [hidden]="!account">
  <ng-container [ngSwitch]="view">

    <ng-container *ngSwitchCase="'FORM'">
      <h5 class="card-deposit__title" translate="label.deposit.uae.cards"></h5>

      <section class="card-deposit__step" *ngIf="cardsLoading || cybersourceEnbdCards.length">
        <div class="card-deposit__step-heading">
          <span class="card-deposit__step-badge"><span>1</span></span>
          <span class="card-deposit__step-title" translate="label.deposit.creditCard.step1"></span>
        </div>

        <div *ngIf="cardsLoading" class="card-deposit__saved-cards-loading" translate="label.processing.message"></div>

        <ng-container *ngIf="!cardsLoading">
          <div class="card-deposit__card-field" #cardDropdown>
            <button type="button" class="card-deposit__dropdown-trigger" (click)="toggleDropdown()"
              [class.card-deposit__dropdown-trigger--open]="dropdownOpen">
              <ng-container *ngIf="selectedCard as card; else placeholderCard">
                <img class="card-deposit__brand" [class.card-deposit__brand--other]="cardBrandIcon(card).endsWith('other.png')" [src]="cardBrandIcon(card)" alt="">
                <span class="card-deposit__card-details">
                  <span class="card-deposit__card-name">{{ card.cardType | titlecase }}</span>
                  <span class="card-deposit__card-meta">**** {{ card.maskedCardNumber.slice(-4) }}</span>
                </span>
              </ng-container>
              <ng-template #placeholderCard>
                <img class="card-deposit__brand card-deposit__brand--other" src="assets/img/deposits/deposit-drop-other.png" alt="">
                <span class="card-deposit__card-details">
                  <span class="card-deposit__card-name" translate="label.debit.card.newCard"></span>
                </span>
              </ng-template>
              <fa-icon class="card-deposit__chevron" [icon]="chevronIcon"></fa-icon>
            </button>

            <ul class="card-deposit__dropdown-menu" *ngIf="dropdownOpen">
              <li *ngFor="let card of cybersourceEnbdCards"
                class="card-deposit__dropdown-item"
                [class.card-deposit__dropdown-item--selected]="selectedCardId === card.id"
                (click)="selectCard(card)">
                <img class="card-deposit__brand" [class.card-deposit__brand--other]="cardBrandIcon(card).endsWith('other.png')" [src]="cardBrandIcon(card)" alt="">
                <span class="card-deposit__card-details">
                  <span class="card-deposit__card-name">{{ card.cardType | titlecase }}</span>
                  <span class="card-deposit__card-meta">**** {{ card.maskedCardNumber.slice(-4) }}</span>
                </span>
                <!-- <span *ngIf="card.isDefaultCard" class="card-deposit__default-card" aria-label="Default card">★</span> -->
                <span class="card-deposit__check" *ngIf="selectedCardId === card.id" aria-hidden="true"></span>
              </li>
              <li class="card-deposit__dropdown-item"
                [class.card-deposit__dropdown-item--selected]="selectedCardId === null"
                (click)="selectCard(null)">
                <img class="card-deposit__brand card-deposit__brand--other" src="assets/img/deposits/deposit-drop-other.png" alt="">
                <span class="card-deposit__card-details">
                  <span class="card-deposit__card-name" translate="label.debit.card.newCard"></span>
                </span>
                <span class="card-deposit__check" *ngIf="selectedCardId === null" aria-hidden="true"></span>
              </li>
            </ul>
          </div>

          <button
            *ngIf="selectedCard"
            type="button"
            class="btn btn-link card-deposit__delete-link px-0"
            [disabled]="deletingCardId !== null"
            (click)="deleteCreditCardConfirm(selectedCard)"
            hasRole="CAN_DELETE_PAYMENT_METHODS">
            <fa-icon [icon]="deleteIcon"></fa-icon>
            <span translate="label.credit.card.delete.button"></span>
          </button>

          <div class="mt-2 new-card__description" *ngIf="selectedCardId === null" translate="label.debit.card.newCard.description"></div>
        </ng-container>
      </section>

      <section class="card-deposit__step">
        <div class="card-deposit__step-heading">
          <span class="card-deposit__step-badge"><span>{{ cybersourceEnbdCards.length > 0 ? 2 : 1 }}</span></span>
          <span class="card-deposit__step-title" translate="label.deposit.debitCard.step1"></span>
        </div>

        <cp-deposit-form
          [account]="account"
          [currencies]="currencies"
          [hidePromoCode]="true"
          [hideSubmitButton]="true"
          [emptyCurrencyDefault]="true"
          (submit)="startTransaction($event)">
        </cp-deposit-form>
      </section>

      <div class="card-deposit__info-banner">
        <img class="card-deposit__info-icon" src="assets/img/deposits/error.png" alt="">
        <span translate="label.deposit.card.redirectInfo"></span>
      </div>

      <button type="button" class="btn btn-success card-deposit__continue" translate="label.continue"
        [disabled]="!canContinue" (click)="onContinue()"></button>

      <p class="card-deposit__footnote xx-small" translate="label.deposit.thirdPartyFunding.note"></p>
    </ng-container>

    <ng-container *ngSwitchCase="'CHECKOUT'">
      <div class="card-deposit__checkout-header">
        <h5 class="card-deposit__title mb-0" translate="label.deposit.uae.cards.continue"></h5>
        <button type="button" class="card-deposit__cancel" translate="label.cancel" (click)="backToForm()"></button>
      </div>

      <div class="cs-enbd-checkout" [class.cs-enbd-checkout--embedded]="useEmbeddedCheckout">
        <div *ngIf="sdkLoading" class="cs-enbd-spinner-wrap">
          <div class="cs-enbd-spinner"></div>
          <p translate="label.processing.message"></p>
        </div>

        <ng-container *ngIf="useEmbeddedCheckout; else sidebarMount">
          <div id="cs-enbd-payment-selection" class="cs-enbd-selection"></div>
          <div id="cs-enbd-payment-screen" class="cs-enbd-screen"></div>
        </ng-container>
        <ng-template #sidebarMount>
          <div id="cs-enbd-payment-container" class="cs-enbd-container"></div>
        </ng-template>
      </div>
    </ng-container>

    <ng-container *ngSwitchCase="'SUCCESS'">
      <div class="card-deposit__result">
        <img class="card-deposit__result-icon" src="assets/img/deposits/status-success.svg" alt="">
        <h5 class="card-deposit__result-title" translate="label.deposit.enbd.result.success"></h5>
        <p *ngIf="paymentId" class="card-deposit__result-ref">
          <span translate="label.deposit.enbd.reference"></span>: {{ paymentId }}
        </p>
        <button type="button" class="btn btn-success card-deposit__continue" translate="label.close" (click)="onDone()"></button>
      </div>
    </ng-container>

    <ng-container *ngSwitchCase="'PENDING'">
      <div class="card-deposit__result">
        <img class="card-deposit__result-icon" src="assets/img/deposits/status-pending.svg" alt="">
        <h5 class="card-deposit__result-title" translate="label.deposit.enbd.result.pending"></h5>
        <p *ngIf="paymentId" class="card-deposit__result-ref">
          <span translate="label.deposit.enbd.reference"></span>: {{ paymentId }}
        </p>
        <button type="button" class="btn btn-success card-deposit__continue" translate="label.close" (click)="onDone()"></button>
      </div>
    </ng-container>

    <ng-container *ngSwitchCase="'ERROR'">
      <div class="card-deposit__result">
        <img class="card-deposit__result-icon" src="assets/img/deposits/status-fail.svg" alt="">
        <h5 class="card-deposit__result-title" translate="label.deposit.enbd.result.failed"></h5>
        <p *ngIf="paymentId" class="card-deposit__result-ref">
          <span translate="label.deposit.enbd.reference"></span>: {{ paymentId }}
        </p>
        <button type="button" class="btn btn-success card-deposit__continue" translate="label.close" (click)="backToForm()"></button>
      </div>
    </ng-container>

  </ng-container>

  <ng-template #stepUpModal>
    <div class="cs-enbd-stepup-modal">
      <form id="enbd-stepup-form" [action]="safeStepUpUrl" method="POST" target="enbd-stepup-frame" class="d-none">
        <input type="hidden" name="JWT" [value]="stepUpAccessToken">
      </form>
      <iframe
        id="enbd-stepup-frame"
        name="enbd-stepup-frame"
        class="cs-enbd-stepup-frame"
        title="3-D Secure verification"
        (load)="onStepUpFrameLoad()"
        allow="payment *; publickey-credentials-get *; publickey-credentials-create *">
      </iframe>
    </div>
  </ng-template>
</div>
