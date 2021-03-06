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
                    <input type="number" id="superArea" class="list-form-input" placeholder="0">
                </div>
                <div class="list-input-field">
                    <label for="carpetArea">Area (Carpet Area) *</label>
                    <input type="number" id="carpetArea" class="list-form-input" placeholder="0">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="bathRooms">Bathrooms *</label>
                    <input type="number" id="bathRooms" class="list-form-input" placeholder="0">
                </div>
                <div class="list-input-field">
                    <label for="balconies">Balconies *</label>
                    <input type="number" id="balconies" class="list-form-input" placeholder="0">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="coveredParking">Parking (Covered) *</label>
                    <input type="number" id="coveredParking" class="list-form-input" placeholder="0">
                </div>
                <div class="list-input-field">
                    <label for="openParking">Parking (Open) *</label>
                    <input type="number" id="openParking" class="list-form-input" placeholder="0">
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
                    <input type="number" id="floor" class="list-form-input" placeholder="0">
                </div>
                <div class="list-input-field">
                    <label for="totalFloors">Total floors *</label>
                    <input type="number" id="totalFloors" class="list-form-input" placeholder="0">
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
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Availability * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="availability">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">Under Construction</li>
                        <li onclick="changeoption(event)">Ready to move</li>
                        <li onclick="changeoption(event)">Launching</li>
                    </ul>
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
                    <input type="number" id="commsuperArea" class="list-form-input" placeholder="0">
                </div>
                <div class="list-input-field">
                    <label for="commcarpetArea">Area (Carpet Area) *</label>
                    <input type="number" id="commcarpetArea" class="list-form-input" placeholder="0">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="commbathRooms">Bathrooms *</label>
                    <input type="number" id="commbathRooms" class="list-form-input" placeholder="0">
                </div>
                <div class="list-input-field">
                    <label for="commbalconies">Balconies *</label>
                    <input type="number" id="commbalconies" class="list-form-input" placeholder="0">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="commfloor">Floor *</label>
                    <input type="number" id="commfloor" class="list-form-input" placeholder="0">
                </div>
                <div class="list-input-field">
                    <label for="commtotalFloors">Total floors *</label>
                    <input type="number" id="commtotalFloors" class="list-form-input" placeholder="0">
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
        <div class="list-input-field">
            <label for="aFrom">Available From *</label>
            <input type="date" id="aFrom" class="list-form-input"/>
        </div>
        <div class="inventory-options">
            <div class="inventory-heading">Inventory *</div>
            <div class="inventory-lines">
                <div class="count-options">
                    <div class="count-option-label">Beds</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
                <div class="count-options">
                    <div class="count-option-label">Lights</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
                <div class="count-options">
                    <div class="count-option-label">Fans</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
            </div>
            <div class="inventory-lines">
                <div class="count-options">
                    <div class="count-option-label">ACs</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
                <div class="count-options">
                    <div class="count-option-label">Geysers</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
                <div class="count-options">
                    <div class="count-option-label">TVs</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
            </div>
            <div class="inventory-lines">
                <div class="count-options">
                    <div class="count-option-label">Wardrobes</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
                <div class="count-options">
                    <div class="count-option-label">Exhausts</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
                <div class="count-options">
                    <div class="count-option-label">Sofas</div>
                    <input type="number" class="count-option-value" value="0" min="0"/>
                </div>
            </div>
            <div class="line-4">
                <div class="list-form-check-field" id="inventory-checks">
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Modular Kitchen</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Fridge</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Stove</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Washing Machine</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Water purifier</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Curtains</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Microwave</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Chimney</div>
                    </div>
                    <div class="check-option">
                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                        <div class="check-option-value">Dining Table</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input name="configuration" type="text" id="configuration-hidden" hidden>
    <input name="invchecks" type="text" id="invchecks-hidden" hidden>
    <input name="invcounts" type="text" id="invcounts-hidden" hidden>
    <input name="area" type="text" id="area-hidden" hidden>
    <input name="bathRooms" type="text" id="bathRooms-hidden" hidden>
    <input name="balconies" type="text" id="balconies-hidden" hidden>
    <input name="rooms" type="text" id="rooms-hidden" hidden>
    <input name="furnishing" type="text" id="furnishing-hidden" hidden>
    <input name="parking" type="text" id="parking-hidden" hidden>
    <input name="ageOfProperty" type="text" id="ageOfProperty-hidden" hidden>
    <input name="floor" type="text" id="floor-hidden" hidden>
    <input name="totalFloors" type="text" id="totalFloors-hidden" hidden>
    <input name="availableFrom" type="text" id="availableFrom-hidden" hidden>
    <input name="availabilty" type="text" id="availability-hidden" hidden>
    <div class="list-previous-button" onclick="previous2Form()">Previous</div>
</div>