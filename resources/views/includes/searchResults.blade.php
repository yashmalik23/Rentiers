@extends('layout')
@section('views')
    <style>
        #search-price-tag{
            position: absolute;
            margin-top: 10px;
            margin-left: 10px;
            background-color: rgb(58, 110, 201, 0.7);
            color: white;
            padding: 2px 10px;
        }
    </style>
    <script type="text/javascript" src="{{asset('js/search.js') }}"></script>
    <div class="search-section">
        {{--------------- Search bar -----------------}}
        <div class="ext"></div>
        <form class="search-result-container" method="GET" action="{{route('gosearch')}}">
            <div class="search-result-bar"> 
                <div class="drop-down-btn">
                    <div class="drop-down-title" onclick="dropdown(event)" id="search-city">{{$city}}</div>
                    <ul class="drop-down-options">
                        @foreach($cities as $cit)
                        <li onclick="changeoption(event)">{{$cit}}</li>
                        @endforeach
                    </ul>
                    <input name="city" type="text" value="{{$city}}" hidden>
                    <img src="{{asset('images/home/search-down-arrow.svg')}}">
                </div>
                <div class="drop-down-btn">
                    <div class="drop-down-title" onclick="dropdown(event)">{{$listedFor}}</div>
                    <ul class="drop-down-options-2">
                        <li onclick="changeoption(event)">RENT</li>
                        <li onclick="changeoption(event)">BUY</li>
                    </ul>
                    <input name="listedFor" type="text" value="{{$listedFor}}" hidden>
                    <img src="{{asset('images/home/search-down-arrow.svg')}}">
                </div>
                @if(session('search'))
                <input type="text" value="{{session('search')}}" placeholder="Search location or project name" class="search-input" name="search-text" onkeyup="addOptions(event,'{{$localities}}','{{$projects}}')" onblur="hideOptions(event)"/>
                @else
                <input type="text" value="{{$search}}" placeholder="Search location or project name" class="search-input" name="search-text" onkeyup="addOptions(event,'{{$localities}}','{{$projects}}')" onblur="hideOptions(event)"/>
                @endif
                <ul class="data-list">
                </ul>
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
                <img src="{{asset('images/search/minus.svg')}}" id="searchimageplus" onclick="changemain(event)"/>
            </div>
            <div id="main-filters">
                <div class="filter-1-budget">
                    <div class="sub-filter-heading">
                        <div>Budget(₹)</div>
                        <img src="{{asset('images/search/plus.svg')}}" onclick="changesub(event)" />
                    </div>
                    @if(count(explode('_',session('budget')))>1)
                        <div class="input-fields">
                            <input type="number" id="budget-start-from" value="{{explode('_',session('budget'))[0]}}" min="0"/>
                            <div>to</div>
                            <input type="number" id="budget-end-at" value="{{explode('_',session('budget'))[1]}}" min="0"/>
                        </div>
                    @else
                        <div class="input-fields">
                            <input type="number" id="budget-start-from" value="0" min="0"/>
                            <div>to</div>
                            <input type="number" id="budget-end-at" value="0" min="0"/>
                        </div>
                    @endif
                </div>
                <div class="filter-2-furnishing">
                    <div class="sub-filter-heading">
                        <div>Furnishing</div>
                        <img src="{{asset('images/search/plus.svg')}}" onclick="changesub(event)" />
                    </div>
                    @if(session('furn'))
                        <div class="list-form-check-field" id='furnishing-filter'>
                            @for ($i = 0; $i < 3; $i++)
                                @if(str_split(session('furn'))[$i]== "1")
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$furnishing[$i]}}</div>
                                    </div>
                                @else
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$furnishing[$i]}}</div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @else
                        <div class="list-form-check-field" id='furnishing-filter'>
                            @for ($i = 0; $i < 3; $i++)
                                @if(str_split($furn)[$i]== "1")
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$furnishing[$i]}}</div>
                                    </div>
                                @else
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$furnishing[$i]}}</div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endif
                </div>
                <div class="filter-3-configuration">
                    <div class="sub-filter-heading">
                        <div>Configuration</div>
                        <img src="{{asset('images/search/plus.svg')}}" onclick="changesub(event)" />
                    </div>
                    @if(session('conf'))
                        <div class="list-form-check-field" id='configuration-filter'>
                            @for ($i = 0; $i < 6; $i++)
                                @if(str_split(session('conf'))[$i]== "1")
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$configuration[$i]}}</div>
                                    </div>
                                @else
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$configuration[$i]}}</div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @else
                        <div class="list-form-check-field" id='configuration-filter'>
                            @for ($i = 0; $i < 6; $i++)
                                @if(str_split($conf)[$i]== "1")
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$configuration[$i]}}</div>
                                    </div>
                                @else
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$configuration[$i]}}</div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endif
                </div>
                <div class="filter-4-ameneties">
                    <div class="sub-filter-heading">
                        <div>Ameneties</div>
                        <img src="{{asset('images/search/plus.svg')}}" onclick="changesub(event)" />
                    </div>
                    @if(session('amenety'))
                        <div class="list-form-check-field" id='ameneties-filter'>
                            @for ($i = 0; $i < 13; $i++)
                                @if(str_split(session('amenety'))[$i]== "1")
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$ameneties[$i]}}</div>
                                    </div>
                                @else
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$ameneties[$i]}}</div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @else
                        <div class="list-form-check-field" id='ameneties-filter'>
                            @for ($i = 0; $i < 13; $i++)
                                @if(str_split($amenety)[$i]== "1")
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$ameneties[$i]}}</div>
                                    </div>
                                @else
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$ameneties[$i]}}</div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endif
                </div>
                <div class="filter-5-closeTo">
                    <div class="sub-filter-heading">
                        <div>Close To</div>
                        <img src="{{asset('images/search/plus.svg')}}" onclick="changesub(event)" />
                    </div>
                    @if(session('close'))
                        <div class="list-form-check-field" id='closeto-filter'>
                            @for ($i = 0; $i < 7; $i++)
                                @if(str_split(session('close'))[$i]== "1")
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$closeTo[$i]}}</div>
                                    </div>
                                @else
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$closeTo[$i]}}</div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @else
                        <div class="list-form-check-field" id='closeto-filter'>
                            @for ($i = 0; $i < 7; $i++)
                                @if(str_split($close)[$i]== "1")
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/checked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$closeTo[$i]}}</div>
                                    </div>
                                @else
                                    <div class="check-option">
                                        <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" />
                                        <div class="check-option-value">{{$closeTo[$i]}}</div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endif
                </div>
                <button id="apply-filters" onclick="checkAllFilters()">Apply</button>
            </div>
        </div>
        <div class="search-results">
            <br>
            Closest and similar matches to your search
            <br>
            @if(session('props'))
                @foreach(session('props') as $prop)
                <div class="search-result-card">
                    <div class="left-part">
                        <div class="slider">
                            <div class="slider-images">
                                @if(count(explode(",",$prop[$i]->images))>0 && explode(",",$prop[$i]->images)[0] != "" && explode(",",$prop[$i]->images)[0] != "noimage.png")
                                        <div class="slide active">
                                        <img src="/storage/{{$prop[$i]->id}}/{{explode(",",$prop[$i]->images)[0]}}">
                                    </div>
                                @else
                                    <div class="slide active">
                                        <img src="/storage/noimage.png">
                                    </div>
                                @endif
                                @for($j = 1 ; $j<count(explode(",",$prop[$i]->images))-1 ;$j++)
                                    @if($j <3)
                                        @if(explode(",",$prop[$i]->images)[$j] != "")
                                        <div class="slide">
                                            <img src="/storage/{{$prop[$i]->id}}/{{explode(",",$prop[$i]->images)[$j]}}">
                                        </div>
                                        @endif
                                    @endif
                                @endfor
                            </div>  
                        <button class="previous" onclick="previousSlide(event)"><</button>
                        <button class="next" onclick="nextSlide(event)">></button>
                    </div>
                    <div id="search-price-tag">₹ {{$prop->expectedPrice}}</div>
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
                            @for ($i = 0; $i < 13; $i++)
                                @if(str_split($prop->ameneties)[$i]== "1")
                                    <div>{{$ameneties[$i]}}, </div>
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
                <div class="page-links">{{session('props')->appends(request()->query())->links()}}</div>
            @else
                @foreach($props as $prop)
                <div class="search-result-card">
                    <div class="left-part">
                        <div class="slider" style="width:100%;">
                            <div class="slider-images">
                                @if(count(explode(",",$prop->images))>0 && explode(",",$prop->images)[0] != "" && explode(",",$prop->images)[0] != "noimage.png")
                                    <div class="slide active">
                                        <img src="/storage/{{$prop->id}}/{{explode(",",$prop->images)[0]}}">
                                    </div>
                                @else
                                    <div class="slide active">
                                        <img src="/storage/noimage.png">
                                    </div>
                                @endif
                                @for($j = 1 ; $j<count(explode(",",$prop->images))-1 ;$j++)
                                    @if($j <3)
                                        @if(explode(",",$prop->images)[$j] != "")
                                        <div class="slide">
                                            <img src="/storage/{{$prop->id}}/{{explode(",",$prop->images)[$j]}}">
                                        </div>
                                        @endif
                                    @endif
                                @endfor
                            </div>  
                            <button class="previous" onclick="previousSlide(event)"><</button>
                            <button class="next" style="margin-left:94%" onclick="nextSlide(event)">></button>
                        </div>
                    </div>
                    <div id="search-price-tag">₹ {{$prop->expectedPrice}}</div>
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
                        <div class="rest-details-text" style="font-weight:bold;font-size:1.5rem">{{$prop->locality}},{{$prop->city}}</div>
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
                            @for ($i = 0; $i < 13; $i++)
                                @if(str_split($prop->ameneties)[$i]== "1")
                                    <div>{{$ameneties[$i]}}, </div>
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
                <div class="page-links">{{$props->appends(request()->query())->appends(['search-text'=>$search])->links()}}</div>
            @endif
        </div>
        <div class="extra-section">
            <div class="sortBy">
                <div class="radio-option-label">Sort by *</div>
                @if(session('sortBy'))
                    <div class="radio-options" id="sortBy">
                        @for ($i = 0; $i < 4; $i++)
                            @if(str_split(session('sortBy'))[$i]== "1")
                                <div onclick="changeradio(event)">
                                    <img src="{{asset('images/listprops/radio-full.svg')}}" />
                                    <div class="radio-field-name">{{$sort[$i]}}</div>
                                </div>
                            @else
                                <div onclick="changeradio(event)">
                                    <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                                    <div class="radio-field-name">{{$sort[$i]}}</div>
                                </div>
                            @endif
                        @endfor
                    </div>
                @else
                    <div class="radio-options" id="sortBy">
                        @for ($i = 0; $i < 4; $i++)
                            @if(str_split($sortBy)[$i]== "1")
                                <div onclick="changeradio(event)">
                                    <img src="{{asset('images/listprops/radio-full.svg')}}" />
                                    <div class="radio-field-name">{{$sort[$i]}}</div>
                                </div>
                            @else
                                <div onclick="changeradio(event)">
                                    <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                                    <div class="radio-field-name">{{$sort[$i]}}</div>
                                </div>
                            @endif
                        @endfor
                    </div>
                @endif
            </div>
            <div class="help-section">
                <div class="help-heading">Help</div>
                <div class="help-line-1" style="{color:red;}">
                    Click on search icon to apply filters and sorting. There are only 3 images per search result. Click on the property to browse more details.
                </div>
                <div class="help-line-2">
                    If you are stuck and don't know what to do next, you can email us at support@rentiers.in or call us at +91 8860050003/4/6.  
                </div>
            </div>
        </div>
    </div>
@endsection