@extends('layout')
@section('views')


    {{--------------- Home Page ------------------}}
    <script type="text/javascript" src="{{asset('js/home.js') }}"></script>
    <style>
        .nav-links> li> a{
            color: whitesmoke;
        }
        .nav-links> li{
            color: whitesmoke;
        }
        .nav-links> li> ul> li{
            color: white;
    
        }
    </style>

    <div class="main-slider">
        <div class="slider-images">
            <div class="slide active">
                <img src="/storage/main/picture0.jpg">
            </div>
            @for($i=1;$i<$stats->mainprojectlength;$i++)
                <div class="slide">
                    <img src="/storage/main/picture{{$i}}.jpg">
                </div>
            @endfor
        </div>  
        <button class="previous" onclick="previousSlideMain(event)" id="view-previous"><</button>
        <button class="next" onclick="nextSlideMain(event)" id="view-next">></button>
        <input type="number" id="currentProject" value="1" hidden>
        <button id="explore" onclick="viewProject(event)">KNOW MORE</button>
    </div>    

    {{--------------- Search bar -----------------}}
    <form class="search-container" method="GET" action="{{route('normalsearch')}}">
        <!-- @csrf -->
        <div class="search-bar"> 
            <div class="drop-down-btn">
                <div class="drop-down-title" onclick="dropdown(event)">GURUGRAM</div>
                <ul class="drop-down-options">
                    @foreach($cities as $city)
                    <li onclick="changeoption(event)">{{$city}}</li>
                    @endforeach
                </ul>
                <input name="city" type="text" value="GURUGRAM" hidden>
                <img src="{{asset('images/home/search-down-arrow.svg')}}" onclick="droparrow(event)">
            </div>
            <div class="drop-down-btn">
                <div class="drop-down-title" onclick="dropdown(event)">RENT</div>
                <ul class="drop-down-options-2">
                    <li onclick="changeoption(event)">RENT</li>
                    <li onclick="changeoption(event)">BUY</li>
                </ul>
                <input name="listedFor" type="text" value="RENT" hidden>
                <img src="{{asset('images/home/search-down-arrow.svg')}}" onclick="droparrow(event)">
            </div>
            <input type="text" placeholder="Search..." class="search-input" name="search-text" onkeyup="addOptions(event,'{{$localities}}','{{$projects}}')" onblur="hideOptions(event)"/>
            <ul class="data-list">
            </ul>
            <img src="{{asset('images/home/search.svg')}}" class="search-icon" onclick="searchProps()"/>
        </div>
        <button id="gosearch" type="submit" hidden></button>
    </form>


    {{---------------- Recent properties --------------}}
    <div class="recent-properties">
        <div class="recent-title">
            <img src="{{asset('images/home/recent-head.svg')}}" class="recent-head"/>
            <div class="recent-heading">Trending Properties</div>
            <div class="recent-line">You stopped by just in time to see these new properties</div>
            <div class="see-all" onclick="function c(){window.location.href='/search'};c()">View All</div>
        </div>
        <div class="content-slider">
            <div class="card-container">
                @for($i=0;$i<10;$i++)
                    <div class="card" id="card{{$i}}">
                        <div class="slider">
                            <div class="slider-images">
                                @if(count(explode(",",$props[$i]->images))>0 && explode(",",$props[$i]->images)[0] != "" && explode(",",$props[$i]->images)[0] != "noimage.png")
                                    <div class="slide active">
                                        <img src="/storage/{{$props[$i]->id}}/{{explode(",",$props[$i]->images)[0]}}">
                                    </div>
                                @else
                                    <div class="slide active">
                                        <img src="/storage/noimage.png">
                                    </div>
                                @endif
                                @for($j = 1 ; $j<count(explode(",",$props[$i]->images))-1 ;$j++)
                                    @if($j <3)
                                        @if(explode(",",$props[$i]->images)[$j] != "")
                                        <div class="slide">
                                            <img src="/storage/{{$props[$i]->id}}/{{explode(",",$props[$i]->images)[$j]}}">
                                        </div>
                                        @endif
                                    @endif
                                @endfor
                            </div>  
                            <button class="previous" onclick="previousSlide(event)"><</button>
                            <button class="next" onclick="nextSlide(event)">></button>
                            <div class="price-tag">₹ {{$props[$i]->expectedPrice}}</div>
                            <div class="circles">
                                <div class="circle active"></div>
                                @for($j = 1 ; $j<count(explode(",",$props[$i]->images))-1 ;$j++)
                                    @if($j<3)
                                        @if(explode(",",$props[$i]->images)[$j] != "")
                                            <div class="circle"></div>
                                        @endif
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="card-property-name"><a href="/property/{{$props[$i]->id}}" >{{$props[$i]->streetName}}</a></div>
                        <div class="card-property-location">{{$props[$i]->locality}}, {{$props[$i]->city}}</div>
                        <div class="card-amenities">
                            <img src="{{asset('images/home/home-icon.svg')}}">
                            <div>{{$props[$i]->configuration}}</div>
                            <div>{{explode("_",$props[$i]->area)[0]}} sq.ft. / {{intval(explode("_",$props[$i]->area)[0])*0.09}} sq. m.</div>  
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    {{-------------- About Us -------------------------}}
    <div class="home-about">
        <img src="{{asset('images/home/aboutus.svg')}}" class="desktop">
        <img src="{{asset('images/home/mobileabout.svg')}}" class="mobile">
    </div>

    {{----------------- Our clients ---------------------}}
    <div class="our-clients">
        <div class="client-heading">Our clients</div>
        <div class="client-slider">
            @for($i=0;$i<$stats->clientlogolength;$i++)
                <div class="client-card">
                    <img src="/storage/clients/logo{{$i}}.png">
                </div>
            @endfor
        </div>    
    </div>

    {{-------------- Testimonials ---------------------}}
    <div class="testimonials">
        <div class="left-section">
            <div class="left-title-section">
                <img src="{{asset('images/home/quotation-marks.svg')}}">
                <div class="left-inner-section">
                    <div class="test-heading">People love what we do</div>
                    <div class="test-line">The customers come at first place for us. Here is what they say</div>
                </div>
            </div>
            <img src="{{asset('images/home/test-main.svg')}}">
        </div>
        <div class="right-section">
            <img src="{{asset('images/home/test-up-arrow.svg')}}" onclick='scrollUp(event)' />
            <div class="test-cards-container">
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            They were really helpful and patiently understood all our needs. They provided us with whatever help we needed. Five star for their outstanding and professional service.  
                        </div>
                        <div class="name">Aditya Jain</div>
                    </div>
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Rentiers.in is one of the best dealers I have come across. They were helpful and ready to go out of the box to get me the flat. He helped me with everything. I feel the brokerage that I paid was worth it.I will reach out to them to buy/rent any property.  
                        </div>
                        <div class="name">Puneet Kukreja</div>
                    </div>
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            I have taken their services after consulting multiple agents.They are very professional, no fake lines which 90% agents tell, helped during shifting, fought with society or owner for any wrong commitments or issues, very courteous. 
                        </div>
                        <div class="name">Dev Vrat</div>
                    </div>
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            I wanted a 3BHK+SR appartment, They helped me finding out the best appartment in a very good budget. Thank you Rentiers.in
                        </div>
                        <div class="name">Sanjeev Beniwal</div>
                    </div>
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            The service is very good. Rentiers.in were very helpful and honest. They gave me the best deal.
                        </div>
                        <div class="name">Nitin Singh</div>
                    </div>
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            They were very polite and understood our needs completely. They literally went out of their way to help us during shifting. I would recommend anyone who wants a property to contact rentiers.in
                        </div>
                        <div class="name">Yash Malik</div>
                    </div>
                </div>
            </div>
            <img src="{{asset('images/home/test-down-arrow.svg')}}" onclick="scrollDown(event)" />
        </div>
    </div>

@stop