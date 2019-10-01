@extends('layout')
@section('views')
    {{--------------- Home Page ------------------}}
    <script type="text/javascript" src="{{asset('js/home.js') }}"></script>

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
    </div>    

    {{--------------- Headings -------------------}}
    <div class="title-container"> 
        <div class="main-heading">Making Renting Easy</div>
        <div class="main-line">Your homes are...... our first priority.</div>
        <div class="second-line">Welcome to 21st century renting</div>
    </div>

    {{--------------- Search bar -----------------}}
    <div class="search-container">
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


    {{---------------- Recent properties --------------}}
    <div class="recent-properties">
        <div class="recent-title">
            <img src="{{asset('images/home/recent-head.svg')}}" class="recent-head"/>
            <div class="recent-heading">Recent Properties</div>
            <div class="recent-line">You stopped by just in time to see these new properties</div>
            <div class="see-all" onclick="function c(){window.location.href='/search'};c()">View All</div>
        </div>
        <div class="content-slider">
            <div class="card-container">
                @for($i=0;$i<5;$i++)
                    <div class="card">
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
        <div class="go-forward" onclick="scrollRecent(event)">></div>
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
            <div class="client-card-container">
                <input type="hidden" id="numberoflogos" value="{{$stats->clientlogolength}}"/>
                @for($i=0;$i<$stats->clientlogolength;$i++)
                <img src="/storage/clients/logo{{$i}}.svg">
                @endfor
            </div>
            <script>document.getElementsByClassName('client-card-container')[0].style.width = (150*parseInt(document.getElementById('numberoflogos').value)).toString()+"px"</script>
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
                            He was really very helpful and patiently understood all our needs. He provided us with whatever help we needed. Five star for his outstanding and professional service.  
                        </div>
                        <div class="name">Aditya Jain, Entrepreneur</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Shailender is one of the best dealers I have come across. He was gentle, helpful and ready to go out of the box to get me the flat. He helped me with everything. I feel the brokerage that I paid was worth it.I will reach out to him to buy/rent any property in Gurgaon!  
                        </div>
                        <div class="name">Puneet Kukreja</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            I have taken his services after consulting multiple agents. Just to brief:He is very very professional, no Fake lines which 90% agents tell, helped during shifting, fought with society or owner for any wrong commitments or issues, very courteous person, during and after shifting he hasn't mentioned for his fees unlike other people i.e. he is not greedy too. 
                        </div>
                        <div class="name">Dev Vrat</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Wanted a 3BHK+SR appartment, They help me finding out best appartment for me in a very good budget. Thank you Rentiers.in
                        </div>
                        <div class="name">Sanjeev Beniwal</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            The service is very good. Mr. Shailendra is very helpful and honest guy. He gave me the best deal.
                        </div>
                        <div class="name">Nitin Singh</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            He was very polite and understood our needs completely. He literally went out of his way to help us during shifting. I would recommend anyone who wants a property in Gurugram to contact rentiers.in
                        </div>
                        <div class="name">Yash Malik</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
            </div>
            <img src="{{asset('images/home/test-down-arrow.svg')}}" onclick="scrollDown(event)" />
        </div>
    </div>

@stop