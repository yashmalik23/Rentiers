<div id="form-2">
    <script type="text/javascript" src="{{asset('js/editProps/location.js') }}"></script>
    <div class="list-form-heading">Where's the property located?</div>
    <div class="field-inputs">
        <div class="line-4">
            <div class="form-drop-down-options">
                <div class="drop-down-label">City * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id="city">{{$prop->city}}</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list">
                    <li onclick="changeoption(event)">Gurugram</li>
                    <li onclick="changeoption(event)">Hisar</li>
                </ul>
            </div>
            <input name="city" type="text" hidden value="{{$prop->city}}">
        </div>
        <div class="line-4">
            <div class="list-input-field">
                <label for="houseNo">House/Flat Number *</label>
                <input id="houseNo" class="list-form-input" value="{{$prop->houseNo}}"  name="houseNo" required>
            </div>
            <div class="list-input-field">
                <label for="streetName">Street/Project Name *</label>
                <input id="streetName" class="list-form-input" value="{{$prop->streetName}}" name="streetName">
            </div>
        </div>
        <div class="line-4">
            <div class="list-input-field">
                <label for="nearByArea">Landmark </label>
                <input id="nearByArea" class="list-form-input" value="{{$prop->nearByArea}}" name="nearByArea" >
            </div>
            <div class="list-input-field">
                <label for="locality">Locality *</label>
                <input id="locality" class="list-form-input" value="{{$prop->locality}}" name="locality" required>
            </div>
        </div>
    </div>
</div>