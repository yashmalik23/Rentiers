@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/view.js') }}"></script>
    <div class="view-property">
        <div class="view-property-details">
            @foreach ($props as $prop)
                <div class="view-property-header">
                    <div class="view-nearByArea">{{$prop->streetName}}</div>
                    <div class="view-locality">
                    @if (isset(Auth::user()->email))
                        @if(Auth::user()->email == "admin@rentiers.in")
                        {{$prop->houseNo}}
                        @endif
                    @endif
                    {{$prop->locality}}, {{$prop->city}}
                    </div>
                </div>
                <div class="view-slider">
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
                        @for($i =1 ; $i<count(explode(",",$prop->images))-1 ;$i++ )
                            @if(explode(",",$prop->images)[$i] != "")
                            <div class="slide">
                                <img src="/storage/{{$prop->id}}/{{explode(",",$prop->images)[$i]}}">
                            </div>
                            @endif
                        @endfor
                    </div>  
                    <button class="previous" onclick="previousSlide(event)" id="view-previous"><</button>
                    <button class="next" onclick="nextSlide(event)" id="view-next">></button>
                    <div class="price-tag">₹ {{$prop->expectedPrice}}</div>
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
                        <div>{{(explode("_",$prop->parking)[0] == "")?NA:explode("_",$prop->parking)[0]}} parkings</div>
                    </div>
                    <div class="view-prop-main-logo">
                        <img src={{asset('images/search/bathtub.svg')}}>
                        <div>{{$prop->bathRooms}} bathrooms</div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Basic details</div>
                    <div class="rest-details-div">
                        <div class="one-feature">
                            <div class="one-feature-heading">Property Type: </div>
                            <div>{{$prop->propertyType}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">More description: </div>
                            <div>{{$prop->propertySecondType}}, {{($prop->propertyThirdType == "None")? "": $prop->propertyThirdType}}</div>
                        </div>
                        @if(Auth::user() != null)
                            @if(Auth::user()->email=="admin@rentiers.in")
                                <div class="one-feature">
                                    <div class="one-feature-heading">Posted by: </div>
                                    <div>{{$prop->postedBy}} for {{$prop->listedFor}}</div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Close details</div>
                    <div class="rest-details-div">
                        @if ($prop->propertyType == "Residential")
                            <div class="one-feature">
                                <div class="one-feature-heading">Configuration: </div>
                                <div>{{$prop->configuration}}</div>
                            </div>
                            <div class="one-feature">
                                <div class="one-feature-heading">Parkings: </div>
                                <div>{{explode("_",$prop->parking)[0]}} (Covered) and {{explode("_",$prop->parking)[1]}} (Open)</div>
                            </div>
                            <div class="one-feature">
                                <div class="one-feature-heading">Other rooms: </div>
                                @if ($prop->rooms == "0")
                                    <div>None</div>
                                @elseif ($prop->rooms == "1")
                                    <div>Study Room</div>
                                @elseif ($prop->rooms == "10")
                                    <div>Servant Room</div>
                                @elseif ($prop->rooms == "11")
                                    <div>Servant Room, Study Room</div>
                                @elseif ($prop->rooms == "100")
                                    <div>Pooja room</div>
                                @elseif ($prop->rooms == "101")
                                    <div>Pooja Room, Study Room</div>
                                @elseif ($prop->rooms == "110")
                                    <div>Pooja Room, Servant Room</div>
                                @else
                                    <div>Pooja Room, Servant Room, Study Room</div>
                                @endif
                            </div>
                        @endif
                        <div class="one-feature">
                            <div class="one-feature-heading">Availabilty: </div>
                            <div>{{$prop->availability}}, available from {{$prop->availableFrom}}</div>
                        </div>
                        <div class="more-feature-inven">
                            <span class="one-feature-heading">Inventory: </span>
                                    @for ($i = 0; $i < 9; $i++)
                                        @if(explode(",",$prop->invcounts)[$i] != "0")
                                            <div> {{explode(",",$prop->invcounts)[$i]}} {{$invcounts[$i]}}</div>
                                        @endif
                                    @endfor
                                    @for ($i = 0; $i <9; $i++)
                                        @if(str_split($prop->invchecks)[$i]== "1")
                                            <div>{{$invchecks[$i]}} </div>
                                        @endif
                                    @endfor
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Balconies: </div>
                            <div>{{$prop->balconies}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Floor: </div>
                            <div>{{$prop->floor}}th out of {{$prop->totalFloors}} floors</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Furnishing: </div>
                            @if ($prop->furnishing == "10")
                                <div>Semi furnished</div>
                            @elseif ($prop->furnishing == "1")
                                <div>Fully furnished</div>
                            @else
                                <div>Unfurnished</div>
                            @endif
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Age of property: </div>
                            <div>{{$prop->ageOfProperty}}</div>
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Pricing</div>
                    <div class="rest-details-div">
                        <div class="one-feature">
                            <div class="one-feature-heading">Price: </div>
                            <div>₹ {{$prop->expectedPrice}},{{($prop->includeTaxes == "No")? "Excluding Taxes": "Including all taxes"}} </div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Additional charges: </div>
                            <div>{{$prop->otherCharges}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Contract type: </div>
                            <div>{{$prop->contract}}</div>
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Features</div>
                    <div class="rest-details-div">
                        <div class="svg-feature">
                            <div class="one-feature-heading">Amenities: </div>
                            <div class="svg-icons">
                                @for ($i = 0; $i < count(str_split($prop->ameneties)); $i++)
                                    @if(str_split($prop->ameneties)[$i]== "1")
                                        <div>
                                            <img src={{asset('images/ameneties/'.($i+1).'.svg')}}>
                                            <div>{{$ameneties[$i]}}</div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="more-feature">
                            <span class="one-feature-heading">Close To: </span>
                            @for ($i = 0; $i < count(str_split($prop->closeTo)); $i++)
                                @if(str_split($prop->closeTo)[$i+7-count(str_split($prop->closeTo))]== "1")
                                    <div>{{$closeTo[$i]}} </div>
                                @endif
                            @endfor
                        </div>
                        @if ($prop->listedFor == "Rent")
                            <div class="more-feature">
                                <span class="one-feature-heading">Tenant preference: </span>
                                @for ($i = 0; $i < count(str_split($prop->tenant)); $i++)
                                    @if(str_split($prop->tenant)[$i]== "1")
                                        <div>{{$tenant[$i+8-count(str_split($prop->tenant))]}}</div>
                                    @endif
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="view-help-section">
            <div class="help-heading">Help</div>
            <div class="help-line-1">
                If you don't know what to do next, you can email us at support@rentiers.in or call us at +91 8860050003/4/6.  
            </div>
        </div>
    </div>
@endsection