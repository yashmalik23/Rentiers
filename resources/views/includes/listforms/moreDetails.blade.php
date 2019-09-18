<div id="form-3">
    <script type="text/javascript" src="{{asset('js/listProps/moreDetails.js') }}"></script>
    <div class="list-form-heading">Give us more information about the property</div>
    <div class="field-inputs">
        <div class="residential-options">
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Configuration * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="configuration">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">1BHK</li>
                        <li onclick="changeoption(event)">2BHK</li>
                        <li onclick="changeoption(event)">3BHK</li>
                        <li onclick="changeoption(event)">4BHK</li>
                        <li onclick="changeoption(event)">5BHK</li>
                        <li onclick="changeoption(event)">More than 5BHK</li>
                    </ul>
                </div>
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Area Unit * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="areaUnit">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">sq.ft.</li>
                        <li onclick="changeoption(event)">sq.yards</li>
                        <li onclick="changeoption(event)">sq.m.</li>
                        <li onclick="changeoption(event)">acres</li>
                        <li onclick="changeoption(event)">hectares</li>
                    </ul>
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="superArea">Area (Super Area) *</label>
                    <input type="number" id="superArea" class="list-form-input" placeholder="1900">
                </div>
                <div class="list-input-field">
                    <label for="carpetArea">Area (Carpet Area) *</label>
                    <input type="number" id="carpetArea" class="list-form-input" placeholder="100">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="bathRooms">Bathrooms *</label>
                    <input type="number" id="bathRooms" class="list-form-input" placeholder="1">
                </div>
                <div class="list-input-field">
                    <label for="balconies">Balconies *</label>
                    <input type="number" id="balconies" class="list-form-input" placeholder="1">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="coveredParking">Parking (Covered) *</label>
                    <input type="number" id="coveredParking" class="list-form-input" placeholder="1">
                </div>
                <div class="list-input-field">
                    <label for="openParking">Parking (Open) *</label>
                    <input type="number" id="openParking" class="list-form-input" placeholder="1">
                </div>
            </div>
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Furnishing * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="furnishing">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">Semi furnished</li>
                        <li onclick="changeoption(event)">Fully furnished</li>
                        <li onclick="changeoption(event)">Unfurnished</li>
                    </ul>
                </div>
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Age of Property * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="ageOfProperty">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">0-2 years</li>
                        <li onclick="changeoption(event)">2-5 years</li>
                        <li onclick="changeoption(event)">5-10 years</li>
                        <li onclick="changeoption(event)">>10 years</li>
                    </ul>
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="floor">Floor *</label>
                    <input type="number" id="floor" class="list-form-input" placeholder="8">
                </div>
                <div class="list-input-field">
                    <label for="totalFloors">Total floors *</label>
                    <input type="number" id="totalFloors" class="list-form-input" placeholder="21">
                </div>
            </div>
            <div class="line-4">
                <div class="list-form-check-field" id="rooms">
                    <div class="check-field-label">Rooms</div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Pooja Room</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Servant Room</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Study Room</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="commercial-options">
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Availability * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="commavailabilty">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">Under Construction</li>
                        <li onclick="changeoption(event)">Ready to move</li>
                        <li onclick="changeoption(event)">Launching</li>
                    </ul>
                </div>
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Area Unit * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="commareaUnit">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">sq.ft.</li>
                        <li onclick="changeoption(event)">sq.yards</li>
                        <li onclick="changeoption(event)">sq.m.</li>
                        <li onclick="changeoption(event)">acres</li>
                        <li onclick="changeoption(event)">hectares</li>
                    </ul>
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="commsuperArea">Area (Super Area) *</label>
                    <input type="number" id="commsuperArea" class="list-form-input" placeholder="1900">
                </div>
                <div class="list-input-field">
                    <label for="commcarpetArea">Area (Carpet Area) *</label>
                    <input type="number" id="commcarpetArea" class="list-form-input" placeholder="100">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="commbathRooms">Bathrooms *</label>
                    <input type="number" id="commbathRooms" class="list-form-input" placeholder="1">
                </div>
                <div class="list-input-field">
                    <label for="commbalconies">Balconies *</label>
                    <input type="number" id="commbalconies" class="list-form-input" placeholder="1">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="commfloor">Floor *</label>
                    <input type="number" id="commfloor" class="list-form-input" placeholder="8">
                </div>
                <div class="list-input-field">
                    <label for="commtotalFloors">Total floors *</label>
                    <input type="number" id="commtotalFloors" class="list-form-input" placeholder="21">
                </div>
            </div>
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Age of Property * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="commageOfProperty">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">0-2 years</li>
                        <li onclick="changeoption(event)">2-5 years</li>
                        <li onclick="changeoption(event)">5-10 years</li>
                        <li onclick="changeoption(event)">>10 years</li>
                    </ul>
                </div>
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Furnishing * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="commfurnishing">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">Semi furnished</li>
                        <li onclick="changeoption(event)">Fully furnished</li>
                        <li onclick="changeoption(event)">Unfurnished</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="list-previous-button" onclick="previous2Form()">Previous</div>
</div>