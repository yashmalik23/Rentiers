<div id="form-3">
    <script type="text/javascript" src="{{asset('js/editProps/moreDetails.js') }}"></script>
    <div class="list-form-heading">Give us more information about the property</div>
    <div class="field-inputs">
        <div class="residential-options">
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Configuration * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="configuration">{{$prop->configuration}}</div>
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
                    <div class="drop-down-heading" onclick="showdrop(event)" id="areaUnit">sq.ft.</div>
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
                    <input type="number" id="superArea" class="list-form-input" value="{{explode('_',$prop->area)[0]}}">
                </div>
                <div class="list-input-field">
                    <label for="carpetArea">Area (Carpet Area) *</label>
                    <input type="number" id="carpetArea" class="list-form-input" value="{{explode('_',$prop->area)[1]}}">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="bathRooms">Bathrooms *</label>
                    <input type="number" id="bathRooms" class="list-form-input" value="{{$prop->bathRooms}}">
                </div>
                <div class="list-input-field">
                    <label for="balconies">Balconies *</label>
                    <input type="number" id="balconies" class="list-form-input" value="{{$prop->balconies}}">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="coveredParking">Parking (Covered) *</label>
                    <input type="number" id="coveredParking" class="list-form-input" value="{{explode('_',$prop->parking)[0]}}">
                </div>
                <div class="list-input-field">
                    <label for="openParking">Parking (Open) *</label>
                    <input type="number" id="openParking" class="list-form-input" value="{{explode('_',$prop->parking)[1]}}">
                </div>
            </div>
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Furnishing * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="furnishing">
                    @if ($prop->furnishing == "1")
                        Fully furnished
                    @elseif ($prop->furnishing == "10")
                        Semi furnished
                    @else
                        Unfurnished
                    @endif
                    </div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">Semi furnished</li>
                        <li onclick="changeoption(event)">Fully furnished</li>
                        <li onclick="changeoption(event)">Unfurnished</li>
                    </ul>
                </div>
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Age of Property * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="ageOfProperty">{{$prop->ageOfProperty}}</div>
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
                    <input type="number" id="floor" class="list-form-input" value="{{$prop->floor}}">
                </div>
                <div class="list-input-field">
                    <label for="totalFloors">Total floors *</label>
                    <input type="number" id="totalFloors" class="list-form-input" value="{{$prop->totalFloors}}">
                </div>
            </div>
            <div class="line-4">
                <div class="list-form-check-field" id="rooms">
                    <div class="check-field-label">Rooms</div>
                    @for ($i = 0; $i < count(str_split($prop->rooms)); $i++)
                        @if(str_split($prop->rooms)[$i]== "1")
                            <div class="check-option">
                                <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                <div class="check-option-value">{{$rooms[$i+3-count(str_split($prop->rooms))]}}</div>
                            </div>
                        @else
                            <div class="check-option">
                                <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                <div class="check-option-value">{{$rooms[$i+3-count(str_split($prop->rooms))]}}</div>
                            </div>
                        @endif
                    @endfor  
                </div>
            </div>
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Availability * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="availability">{{$prop->availability}}</div>
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
                    <div class="drop-down-heading" onclick="showdrop(event)" id="commavailabilty">{{$prop->availability}}</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">Under Construction</li>
                        <li onclick="changeoption(event)">Ready to move</li>
                        <li onclick="changeoption(event)">Launching</li>
                    </ul>
                </div>
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Area Unit * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="commareaUnit">sq.ft.</div>
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
                    <input type="number" id="commsuperArea" class="list-form-input" value="{{explode('_',$prop->area)[0]}}">
                </div>
                <div class="list-input-field">
                    <label for="commcarpetArea">Area (Carpet Area) *</label>
                    <input type="number" id="commcarpetArea" class="list-form-input" value="{{explode('_',$prop->area)[1]}}">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="commbathRooms">Bathrooms *</label>
                    <input type="number" id="commbathRooms" class="list-form-input" value="{{$prop->bathRooms}}">
                </div>
                <div class="list-input-field">
                    <label for="commbalconies">Balconies *</label>
                    <input type="number" id="commbalconies" class="list-form-input" value="{{$prop->balconies}}">
                </div>
            </div>
            <div class="line-4">
                <div class="list-input-field">
                    <label for="commfloor">Floor *</label>
                    <input type="number" id="commfloor" class="list-form-input" value="{{$prop->floor}}">
                </div>
                <div class="list-input-field">
                    <label for="commtotalFloors">Total floors *</label>
                    <input type="number" id="commtotalFloors" class="list-form-input" value="{{$prop->totalFloors}}">
                </div>
            </div>
            <div class="line-3">
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Age of Property * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="commageOfProperty">{{$prop->ageOfProperty}}</div>
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
                    <div class="drop-down-heading" onclick="showdrop(event)" id="commfurnishing">
                        @if ($prop->furnishing == "1")
                            Fully furnished
                        @elseif ($prop->furnishing == "10")
                            Semi furnished
                        @else
                            Unfurnished
                        @endif
                    </div>
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
            <input type="date" id="aFrom" class="list-form-input" value="{{$prop->availableFrom}}"/>
        </div>
        <div class="inventory-options">
            <div class="inventory-heading">Inventory *</div>
            @for($i=0;$i<9;$i=$i+3)
                <div class="inventory-lines">
                    @for($j=0;$j<3;$j++)
                    <div class="count-options">
                        <div class="count-option-label">{{$invcounts[$i+$j]}}</div>
                        <input type="number" class="count-option-value" value="{{explode(",",$prop->invcounts)[$i+$j]}}" min="0"/>
                    </div>
                    @endfor
                </div>
            @endfor
            <div class="line-4">
                <div class="list-form-check-field" id="inventory-checks">
                    @for($i=0;$i<9;$i++)
                        @if(str_split($prop->invchecks)[$i]== "1")
                            <div class="check-option">
                                <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                <div class="check-option-value">{{$invchecks[$i]}}</div>
                            </div>
                        @else
                            <div class="check-option">
                                <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                <div class="check-option-value">{{$invchecks[$i]}}</div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <input name="configuration" type="text" id="configuration-hidden" value="{{$prop->configuration}}" hidden>
    <input name="invchecks" type="text" id="invchecks-hidden" value="{{$prop->invchecks}}" hidden>
    <input name="invcounts" type="text" id="invcounts-hidden" value="{{$prop->invcounts}}"hidden>
    <input name="area" type="text" id="area-hidden" value="{{$prop->area}}" hidden>
    <input name="bathRooms" type="text" id="bathRooms-hidden" value="{{$prop->bathRooms}}" hidden>
    <input name="balconies" type="text" id="balconies-hidden" value="{{$prop->balconies}}"hidden>
    <input name="rooms" type="text" id="rooms-hidden" value="{{$prop->rooms}}" hidden>
    <input name="furnishing" type="text" id="furnishing-hidden" value="{{$prop->furnishing}}" hidden>
    <input name="parking" type="text" id="parking-hidden" value="{{$prop->parking}}" hidden>
    <input name="ageOfProperty" type="text" id="ageOfProperty-hidden" value="{{$prop->ageOfProperty}}" hidden>
    <input name="floor" type="text" id="floor-hidden" value="{{$prop->floor}}" hidden>
    <input name="totalFloors" type="text" id="totalFloors-hidden" value="{{$prop->totalFloors}}" hidden>
    <input name="availableFrom" type="text" id="availableFrom-hidden" value="{{$prop->availableFrom}}" hidden>
    <input name="availabilty" type="text" id="availability-hidden" value="{{$prop->availability}}" hidden>
    <div class="list-previous-button" onclick="previous2Form()">Previous</div>
</div>