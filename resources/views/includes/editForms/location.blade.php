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
                    @foreach($cities as $city)
                    <li onclick="changeoption(event)">{{$city}}</li>
                    @endforeach
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
                <input id="streetName" class="list-form-input" value="{{$prop->streetName}}" name="streetName"  onkeyup="addlistOptions(event,'{{$projects}}')" onblur="hideOptions(event)" required>
                <ul class="dat-list">
                </ul>
            </div>
        </div>
        <div class="line-4">
            <div class="list-input-field">
                <label for="nearByArea">Landmark </label>
                <input id="nearByArea" class="list-form-input" value="{{$prop->nearByArea}}" name="nearByArea" >
            </div>
            <div class="list-input-field">
                <label for="locality">Locality *</label>
                <input id="locality" class="list-form-input" value="{{$prop->locality}}" name="locality" onkeyup="addlistOptions(event,'{{$localities}}')" onblur="hideOptions(event)" required>
                <ul class="dat-list">
                </ul>
            </div>
        </div>
    </div>
</div>