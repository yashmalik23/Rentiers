<div id="form-4">
    <script type="text/javascript" src="{{asset('js/listProps/pricing.js') }}"></script>
    <div class="list-form-heading">What are your expectations?</div>
    <div class="field-inputs">
        <div class="line-3">
            <div class="form-drop-down-options" id="list-contract">
                <div class="drop-down-label">Contract * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id="contract">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list">
                    <li onclick="changeoption(event)">Freehold</li>
                    <li onclick="changeoption(event)">Leasehold</li>
                    <li onclick="changeoption(event)">Co-operative Society</li>
                    <li onclick="changeoption(event)">Power of attorney</li>
                </ul>
            </div>
        </div> 
        <div class="line-3">
            <div class="list-input-field">
                <label for="expectedPrice">Expected price (₹)*</label>
                <input id="expectedPrice" class="list-form-input" placeholder="19000">
            </div>
            <div class="form-drop-down-options">
                <div class="drop-down-label">Include all taxes * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id="includeTaxes">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list">
                    <li onclick="changeoption(event)">Yes</li>
                    <li onclick="changeoption(event)">No</li>
                </ul>
            </div>
        </div> 
        <div class="line-4">
            <div class="list-area-field">
                <label for="otherCharges">Other charges *</label>
                <textarea id="otherCharges" maxlength="191" class="list-form-input" placeholder="5000 Maintenance"></textarea>
            </div>
        </div> 
    </div>
    <div class="list-previous-button" onclick="previous3Form()">Previous</div>
</div>