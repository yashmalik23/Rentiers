<div id="form-2">
    <script type="text/javascript" src="{{asset('js/listProps/location.js') }}"></script>
    <div class="list-form-heading">Where's the property located?</div>
    <div class="field-inputs">
        <div class="line-4">
            <div class="form-drop-down-options">
                <div class="drop-down-label">City * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id="listedFor">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list">
                    <li onclick="changeoption(event)">Gurugram</li>
                    <li onclick="changeoption(event)">Hisar</li>
                </ul>
            </div>
        </div>
        <div class="line-4">
            <div class="list-input-field">
                <label for="houseNo">House/Flat Number *</label>
                <input id="houseNo" class="list-form-input" placeholder="None" required>
            </div>
        </div>
    </div>
</div>