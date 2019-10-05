<div id="form-1">
    <script type="text/javascript" src="{{asset('js/listProps/basicDetails.js') }}"></script>
    <div class="list-form-heading">Let's get Started!</div>
    <div class="field-inputs">
        <div class="radio-option-label">You are *</div>
        <div class="radio-options" id="postedBy">
            <div onclick="changeradio(event)" >
                <img src="{{asset('images/listprops/radio-full.svg')}}" />
                <div class="radio-field-name">Owner</div>
            </div>
            <div onclick="changeradio(event)" >
                <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                <div class="radio-field-name">Broker</div>
            </div>
        </div>
        <input name="postedBy" type="text" hidden value="Owner">
        <div class="line-3">
            <div class="form-drop-down-options">
                <div class="drop-down-label">Reason For listing * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id="listedFor">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list">
                    <li onclick="changeoption(event)">Rent</li>
                    <li onclick="changeoption(event)">Sell</li>
                    <li onclick="changeoption(event)">Paying Guest</li>
                </ul>
            </div>
            <input name="listedFor" type="text" hidden>
            <div class="form-drop-down-options">
                <div class="drop-down-label">Property Type * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id="propertyType">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list">
                    <li onclick="changeoption(event)">Residential</li>
                    <li onclick="changeoption(event)">Commercial</li>
                </ul>
            </div>
            <input name="propertyType" type="text" hidden>
        </div>
        <div class="line-4">
            <div class="form-drop-down-options" id="res-options">
                <div class="drop-down-label">Property * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id= "propertySecondType">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list" id="populate-second-option">
                </ul>
            </div>
            <input name="propertySecondType" type="text" hidden>
        </div>
        <div class="line-4">
            <div class="form-drop-down-options" id="more-options">
                <div class="drop-down-label">More details * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id= "propertyThirdType">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list" id="populate-third-option">
                </ul>
            </div>
            <input name="propertyThirdType" type="text" hidden>
        </div>
        <div class="line-4">
            <div class="form-drop-down-options" id="multiple-units">
                <div class="drop-down-label">Multiple Units * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id="multipleUnits">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list" id="multiple-unit">
                </ul>
            </div>
            <input name="multipleUnits" type="text" hidden value="No">
        </div>
    </div>
</div>