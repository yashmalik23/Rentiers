<div id="form-2">
    <script type="text/javascript" src="{{asset('js/listProps/location.js') }}"></script>
    <div class="list-form-heading">Where's the property located?</div>
    <div class="field-inputs">
        <div class="line-4">
            <div class="form-drop-down-options">
                <div class="drop-down-label">City * </div>
                <div class="drop-down-heading" onclick="showdrop(event)" id="city">Select</div>
                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                <ul class="drop-down-list">
                    @foreach($cities as $city)
                    <li onclick="changeoption(event)">{{$city}}</li>
                    @endforeach
                </ul>
            </div>
            <input name="city" type="text" hidden>
        </div>
        <div class="line-4">
            <div class="list-input-field">
                <label for="houseNo">House/Flat Number *</label>
                <input id="houseNo" class="list-form-input" placeholder="Type..."  name="houseNo" required>
            </div>
            <div class="list-input-field">
                <label for="streetName">Street/Project Name *</label>
                <input id="streetName" class="list-form-input" placeholder="Type..." name="streetName" onkeyup="addlistOptions(event,'{{$projects}}')" onblur="hideOptions(event)" required>
                <ul class="dat-list">
                </ul>
            </div>
        </div>
        <div class="line-4">
            <div class="list-input-field">
                <label for="nearByArea">Landmark </label>
                <input id="nearByArea" class="list-form-input" placeholder="Type..." name="nearByArea" >
            </div>
            <div class="list-input-field">
                <label for="locality">Locality *</label>
                <input id="locality" class="list-form-input" placeholder="Type..." name="locality" onkeyup="addlistOptions(event,'{{$localities}}')" onblur="hideOptions(event)" required>
                <ul class="dat-list">
                </ul>
            </div>
        </div>
        <div class="list-previous-button" onclick="previousForm()">Previous</div>
    </div>
</div>