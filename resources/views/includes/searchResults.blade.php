@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/search.js') }}"></script>
    <div class="search-section">
        {{--------------- Search bar -----------------}}
        <form class="search-result-container" method="POST" action="{{route('gosearch')}}">
            @csrf
            <div class="search-bar"> 
                <div class="drop-down-btn">
                    <div class="drop-down-title" onclick="dropdown(event)" id="search-city">{{$city}}</div>
                    <ul class="drop-down-options">
                        <li onclick="changeoption(event)">GURUGRAM</li>
                        <li onclick="changeoption(event)">HISAR</li>
                    </ul>
                    <input name="city" type="text" value="GURUGRAM" hidden>
                    <img src="{{asset('images/home/search-down-arrow.svg')}}">
                </div>
                <div class="drop-down-btn">
                    <div class="drop-down-title" onclick="dropdown(event)">{{$listedFor}}</div>
                    <ul class="drop-down-options-2">
                        <li onclick="changeoption(event)">RENT</li>
                        <li onclick="changeoption(event)">BUY</li>
                    </ul>
                    <input name="listedFor" type="text" value="RENT" hidden>
                    <img src="{{asset('images/home/search-down-arrow.svg')}}">
                </div>
                <input type="text" value="{{$search}}" placeholder="Search property" class="search-input" name="search-text" />
                <img src="{{asset('images/home/search.svg')}}" class="search-icon" onclick="checkAllFilters()"/>
            </div>
            <input type="text" name="budget" id="budget-hidden" value="{{$budget}}" hidden/>
            <input type="text" name="furnishing" id="furnishing-hidden"value="{{$furn}}" hidden/>
            <input type="text" name="configuration" id="configuration-hidden" value="{{$conf}}" hidden/>
            <input type="text" name="ameneties" id="ameneties-hidden" value="{{$amenety}}" hidden/>
            <input type="text" name="closeto" id="closeto-hidden" value="{{$close}}" hidden/>
            <input type="text" name="sortBy" id="sortBy-hidden" value="{{$sortBy}}" hidden/>
            <button type="submit" id="gosearch" hidden></button>
        </form>
        {{-- -------------Filters --------------------}}
        <div class="search-filters">
            <div class="filter-heading">
                <div>Filters</div>
                <img src="{{asset('images/search/plus.svg')}}" id="searchimageplus" onclick="changemain(event)"/>
            </div>
            <div id="main-filters">
                <div class="filter-1-budget">
                    <div class="sub-filter-heading">
                        <div>Budget(₹)</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="input-fields">
                        <input type="number" id="budget-start-from" value="{{explode("_",$budget)[0]}}" min="0"/>
                        <div>to</div>
                        <input type="number" id="budget-end-at" value="{{explode("_",$budget)[0]}}" min="0"/>
                    </div>
                </div>
                <div class="filter-2-furnishing">
                    <div class="sub-filter-heading">
                        <div>Furnishing</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="list-form-check-field" id='furnishing-filter'>
                        @for ($i = 0; $i < count(str_split($furn)); $i++)
                            @if(str_split($furn)[$i]== "1")
                                <div class="check-option">
                                    <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                    <div class="check-option-value">{{$furnishing[$i+3-count(str_split($furn))]}}</div>
                                </div>
                            @else
                                <div class="check-option">
                                    <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                    <div class="check-option-value">{{$furnishing[$i+3-count(str_split($furn))]}}</div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="filter-3-configuration">
                    <div class="sub-filter-heading">
                        <div>Configuration</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="list-form-check-field" id='configuration-filter'>
                        @for ($i = 0; $i < count(str_split($conf)); $i++)
                            @if(str_split($conf)[$i]== "1")
                                <div class="check-option">
                                    <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                    <div class="check-option-value">{{$configuration[$i+6-count(str_split($conf))]}}</div>
                                </div>
                            @else
                                <div class="check-option">
                                    <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                    <div class="check-option-value">{{$configuration[$i+6-count(str_split($conf))]}}</div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="filter-4-ameneties">
                    <div class="sub-filter-heading">
                        <div>Ameneties</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="list-form-check-field" id='ameneties-filter'>
                        @for ($i = 0; $i < count(str_split($amenety)); $i++)
                            @if(str_split($amenety)[$i]== "1")
                                <div class="check-option">
                                    <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                    <div class="check-option-value">{{$ameneties[$i+15-count(str_split($amenety))]}}</div>
                                </div>
                            @else
                                <div class="check-option">
                                    <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                    <div class="check-option-value">{{$ameneties[$i+15-count(str_split($amenety))]}}</div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="filter-5-closeTo">
                    <div class="sub-filter-heading">
                        <div>Close To</div>
                        <img src="{{asset('images/search/minus.svg')}}" onclick="changesub(event)" />
                    </div>
                    <div class="list-form-check-field" id='closeto-filter'>
                        @for ($i = 0; $i < count(str_split($close)); $i++)
                            @if(str_split($close)[$i]== "1")
                                <div class="check-option">
                                    <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                    <div class="check-option-value">{{$closeTo[$i+7-count(str_split($close))]}}</div>
                                </div>
                            @else
                                <div class="check-option">
                                    <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                    <div class="check-option-value">{{$closeTo[$i+7-count(str_split($close))]}}</div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="search-results">
            @foreach($props as $prop)
            <div class="search-result-card">
                <div class="left-part">
                    @if(explode(",",$prop->images)[0] != "" && explode(",",$prop->images)[0] != "noimage.png")
                        <img class="searchpropimage" src="/storage/{{$prop->id}}/{{explode(",",$prop->images)[0]}}">
                    @else
                        <img class="searchpropimage" src="/storage/noimage.png"/>
                    @endif
                </div>
                <div class="view-main-details">
                    <div class="view-prop-main-logo">
                        <img src={{asset('images/search/home.svg')}}>
                        <div>{{$prop->configuration}}</div>
                    </div>
                    <div class="view-prop-main-logo">
                        <img src={{asset('images/search/area.svg')}}>
                        <div>{{explode("_",$prop->area)[0]}} sq.ft. / {{intval(explode("_",$prop->area)[0])*0.09}} sq. m.</div>
                    </div>
                    <div class="view-prop-main-logo">
                        <img src={{asset('images/search/parking.svg')}}>
                        <div>{{explode("_",$prop->parking)[0]}} parkings</div>
                    </div>
                    <div class="view-prop-main-logo">
                        <img src={{asset('images/search/bathtub.svg')}}>
                        <div>{{$prop->bathRooms}} bathrooms</div>
                    </div>
                </div>
                <div class="right-part">
                    <div class="rest-details-name"><a href="/property/{{$prop->id}}">{{$prop->streetName}}</a></div>
                    <div class="rest-details-text">{{$prop->locality}},{{$prop->city}}</div>
                    <div class="rest-details-text">
                        @if ($prop->furnishing == "10")
                            Semi furnished
                        @elseif ($prop->furnishing == "1")
                            Fully furnished
                        @else
                            Unfurnished
                        @endif
                        for {{$prop->listedFor}}
                    </div>
                    <div class="one-feature">
                        <div class="one-feature-heading">Amenities: </div>
                        @for ($i = 0; $i < count(str_split($prop->ameneties)); $i++)
                            @if(str_split($prop->ameneties)[$i]== "1")
                                <div>{{$ameneties[$i+15-count(str_split($prop->ameneties))]}}, </div>
                            @endif
                        @endfor
                    </div>
                    <div class="one-feature">
                        <div class="one-feature-heading">Close To: </div>
                        @for ($i = 0; $i < count(str_split($prop->closeTo)); $i++)
                            @if(str_split($prop->closeTo)[$i+7-count(str_split($prop->closeTo))]== "1")
                                <div>{{$closeTo[$i]}}, </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            @endforeach
            <div class="page-links">{{$props->links()}}</div>
        </div>
        <div class="extra-section">
            <div class="sortBy">
                <div class="radio-option-label">Sort by *</div>
                <div class="radio-options" id="sortBy">
                    @for ($i = 0; $i < count(str_split($sortBy)); $i++)
                        @if(str_split($sortBy)[$i]== "1")
                            <div onclick="changeradio(event)">
                                <img src="{{asset('images/listprops/radio-full.svg')}}" />
                                <div class="radio-field-name">{{$sort[$i+4-count(str_split($sortBy))]}}</div>
                            </div>
                        @else
                            <div onclick="changeradio(event)">
                                <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                                <div class="radio-field-name">{{$sort[$i+4-count(str_split($sortBy))]}}</div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="help-section">
                <div class="help-heading">Help</div>
                <div class="help-line-1">
                    Click on search icon to apply filters and sorting.If you are stuck and don't know what to do next, you can email us at support@rentiers.in or call us at +91 8860050003/4/6.  
                </div>
            </div>
        </div>
    </div>
@endsection