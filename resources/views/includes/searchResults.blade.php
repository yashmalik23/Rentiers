@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/search.js') }}"></script>
    <div class="search-section">
        {{--------------- Search bar -----------------}}
        <div class="search-result-container">
            <div class="search-bar"> 
                <div class="drop-down-btn">
                    <div class="drop-down-title" onclick="dropdown(event)">GURUGRAM</div>
                    <ul class="drop-down-options">
                        <li onclick="changeoption(event)">GURUGRAM</li>
                        <li onclick="changeoption(event)">HISAR</li>
                    </ul>
                    <img src="{{asset('images/home/search-down-arrow.svg')}}">
                </div>
                <div class="drop-down-btn">
                    <div class="drop-down-title" onclick="dropdown(event)">RENT</div>
                    <ul class="drop-down-options-2">
                        <li onclick="changeoption(event)">RENT</li>
                        <li onclick="changeoption(event)">BUY</li>
                    </ul>
                    <img src="{{asset('images/home/search-down-arrow.svg')}}">
                </div>
                <input type="text" placeholder="Search..." class="search-input"/>
                <img src="{{asset('images/home/search.svg')}}" class="search-icon"/>
            </div>
        </div>
        {{-- -------------Filters --------------------}}
        <div class="search-filters">
            <div class="filter-heading">
                <div>Filters</div>
                <img src="{{asset('images/search/minus.svg')}}" onclick="changemain(event)"/>
            </div>
            <div id="main-filters">
                <div class="filter-1-budget">
                    <div class="sub-filter-heading">
                        <div>Budget</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="input-fields">
                        <input type="number" id="budget-start-from" />
                        <div>to</div>
                        <input type="number" id="budget-end-at" />
                    </div>
                </div>
                <div class="filter-2-furnishing">
                    <div class="sub-filter-heading">
                        <div>Furnishing</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="list-form-check-field" id='furnishing-filter'>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Unfurnished</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Fully furnished</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Semi furnished</div>
                        </div>
                    </div>
                </div>
                <div class="filter-3-configuration">
                    <div class="sub-filter-heading">
                        <div>Configuration</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="list-form-check-field" id='configuration-filter'>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">1BHK</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">2BHK</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">3BHK</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">4BHK</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">5BHK</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">>5BHK</div>
                        </div>
                    </div>
                </div>
                <div class="filter-4-ameneties">
                    <div class="sub-filter-heading">
                        <div>Ameneties</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="list-form-check-field" id='configuration-filter'>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Air-conditioner</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Swimming Pool</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Sports Arena</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Parks</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Gym</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Intercom</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Lifts</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Visitor Parking</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Chimney</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Pet friendly</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Power backup</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Wheelchair friendly</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Gated society</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">24*7 water</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Wooden floor</div>
                        </div>
                    </div>
                </div>
                <div class="filter-5-closeTo">
                    <div class="sub-filter-heading">
                        <div>Close To</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="list-form-check-field" id='configuration-filter'>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Metro Station</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Main Road</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Hospital</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">School</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Bus Stand</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Railway Station</div>
                        </div>
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                            <div class="check-option-value">Market</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-results">
        </div>
        <div class="extra-section">
            <div class="sortBy">
                <div class="radio-option-label">Sort by *</div>
                <div class="radio-options" id="sortBy">
                    <div onclick="changeradio(event)" >
                        <img src="{{asset('images/listprops/radio-full.svg')}}" />
                        <div class="radio-field-name">Relevance</div>
                    </div>
                    <div onclick="changeradio(event)" >
                        <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                        <div class="radio-field-name">Price: Low to high</div>
                    </div>
                    <div onclick="changeradio(event)" >
                        <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                        <div class="radio-field-name">Price: High to low</div>
                    </div>
                    <div onclick="changeradio(event)" >
                        <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                        <div class="radio-field-name">Date: Newest first</div>
                    </div>
                </div>
            </div>
            <div class="help-section">
                <div class="help-heading">Help</div>
                <div class="help-line-1">
                    If you are stuck on the form and don't know what to do next, you can email us at support@rentiers.in or call us at +91 9414573503.  
                </div>
            </div>
        </div>

    </div>
@endsection