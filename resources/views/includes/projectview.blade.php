@extends('layout')
@section('views')
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success!</strong> Interest submitted.
    </div>
    @endif
    <script type="text/javascript" src="{{asset('js/view.js') }}"></script>
    <div class="view-property">
        <div class="view-property-details">
                <div class="view-property-header">
                    <div class="view-nearByArea">{{$project->projectName}}</div>
                    <div class="view-locality">{{$project->streetName}}, {{$project->city}}</div>
                </div>
                <div class="view-slider">
                    <div class="slider-images">
                        @for($i=0; $i< count(explode(',',$project->images)); $i++)
                        <div class="slide active">
                            <img src="/storage/projects/{{$project->id}}/{{explode(',',$project->images)[$i]}}">
                        </div>
                        @endfor
                    </div>  
                    <button class="previous" onclick="previousSlide(event)" id="view-previous"><</button>
                    <button class="next" onclick="nextSlide(event)" id="view-next">></button>
                    <div class="price-tag">₹ {{$project->basePrice}}</div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Basic Details</div>
                    <div class="rest-details-div">
                        <div class="one-feature">
                            <div class="one-feature-heading">Project Type: </div>
                            <div>{{$project->projectType}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Configurations: </div>
                            <div>{{$project->configurations}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">New booking base price: </div>
                            <div>₹ {{$project->basePrice}}</div>
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Project Details</div>
                    <div class="rest-details-div">
                        <div class="one-feature">
                            <div class="one-feature-heading">Number of towers: </div>
                            <div>{{$project->towers}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Number of floors: </div>
                            <div>{{$project->floors}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Number of units:</div>
                            <div>{{$project->units}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Total project area:</div>
                            <div>{{$project->area}}</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Open Area:</div>
                            <div>{{$project->openArea}}</div>
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Floor plans</div>
                </div>
                <div class="tab-slider">
                    <div class="tabs-header">
                        <div class="tabs active" onclick="changeTab(event,0, '₹ {{explode(',',$project->floorPrices)[0]}}')" >{{explode(',',$project->floorPlanHeads)[0]}}</div>
                        @for($i=1;$i<count(explode(',',$project->floorPlanHeads));$i++)
                            <div class="tabs" onclick="changeTab(event,{{$i}}, '₹ {{explode(',',$project->floorPrices)[$i]}}')">{{explode(',',$project->floorPlanHeads)[$i]}}</div>
                        @endfor
                    </div>
                    <div class="tabs-content">
                        <img class="tabcontent active" src="/storage/projects/{{$project->id}}/{{explode(',',$project->floorPlanImages)[0]}}" />
                        @for($i=1;$i<count(explode(',',$project->floorPlanImages));$i++)
                            <img class="tabcontent" src="/storage/projects/{{$project->id}}/{{explode(',',$project->floorPlanImages)[$i]}}" />
                        @endfor
                    </div>
                    <div id="tab-price-tag">₹{{explode(',',$project->floorPrices)[0]}}</div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Locality information</div>
                    <div class="rest-details-div">
                        @for($i=0;$i<count(explode('#',$project->localityInfo));$i++)
                            <div class="one-feature">
                                <div class="one-feature-heading">{{explode('#',$project->localityInfo)[$i]}}</div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Features</div>
                    <div class="rest-details-div">
                        <div class="svg-feature">
                            <div class="one-feature-heading">Amenities: </div>
                            <div class="svg-icons">
                                @for($i=1;$i<=count(str_split($project->amenities));$i++)
                                @if(str_split($project->amenities)[$i-1] == 1)
                                    <div>
                                        <img src="/images/ameneties/{{$i}}.svg">
                                        <div>{{$amen[$i-1]}}</div>
                                    </div>
                                @endif
                                @endfor
                            </div>
                        </div>
                        <div class="more-feature">
                            <span class="one-feature-heading">Lifestyle: </span>
                            @for($i=0;$i<count(explode(',',$project->lifestyle));$i++)
                                <div>{{explode(',',$project->lifestyle)[$i]}}</div>
                            @endfor
                        </div>
                        <div class="more-feature">
                            <span class="one-feature-heading">Security: </span>
                            @for($i=0;$i<count(explode(',',$project->security));$i++)
                                <div>{{explode(',',$project->security)[$i]}}</div>
                            @endfor
                        </div>
                        <div class="more-feature">
                            <span class="one-feature-heading">Services: </span>
                            @for($i=0;$i<count(explode(',',$project->services));$i++)
                                <div>{{explode(',',$project->services)[$i]}}</div>
                            @endfor
                        </div>
                        <div class="more-feature">
                            <span class="one-feature-heading">Others: </span>
                            @for($i=0;$i<count(explode(',',$project->others));$i++)
                                <div>{{explode(',',$project->others)[$i]}}</div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Similar projects</div>
                </div>
                <div class="similar-slider">
                    <div class="card-container">
                        @for($i=0;$i<5;$i++)
                            <div class="card">
                                <div class="slider">
                                    <div class="slider-images">
                                    @for($j=0; $j< count(explode(',',$sugg[$i]->images)); $j++)
                                        <div class="slide active">
                                            <img src="/storage/projects/{{$sugg[$i]->id}}/{{explode(',',$sugg[$i]->images)[$j]}}">
                                        </div>
                                    @endfor
                                    </div>  
                                    <button class="previous" onclick="previousSlide(event)"><</button>
                                    <button class="next" onclick="nextSlide(event)">></button>
                                </div>
                                <div class="card-property-name"><a href="/property/" >{{$sugg[$i]->projectName}}</a></div>
                                <div class="card-property-location">{{$sugg[$i]->streetName}}, {{$sugg[$i]->city}}</div>
                                <div class="card-amenities">
                                    <img src="{{asset('images/home/home-icon.svg')}}"/>
                                    <div>{{$sugg[$i]->configurations}}</div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
        </div>
        <div class="view-help-section">
            <div class="help-heading">Help</div>
            <div class="help-line-1">
                If you don't know what to do next, you can email us at support@rentiers.in or call us at +91 8860050003/4/6.  
            </div>
        </div>

    </div>
@endsection