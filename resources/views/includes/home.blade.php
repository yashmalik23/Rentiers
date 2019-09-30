@extends('layout')
@section('views')
    {{--------------- Home Page ------------------}}
    <script type="text/javascript" src="{{asset('js/home.js') }}"></script>

    <div class="main-slider">
        <div class="slider-images">
            <div class="slide active">
                <img src="/images/home/picture.jpg">
            </div>
            <div class="slide">
                <img src="/images/home/picture.jpg">
            </div>
            <div class="slide">
                <img src="/images/home/picture2.png">
            </div>
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
            <div class="see-all">View All</div>
        </div>
        <div class="content-slider">
            <div class="card-container">
                <div class="card">
                        <div class="slider">
                            <div class="slider-images">
                                <div class="slide active">
                                    <img src="{{asset('images/home/picture2.png')}}">
                                </div>
                                <div class="slide">
                                    <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                            </div>  
                            <button class="previous" onclick="previousSlide(event)"><</button>
                            <button class="next" onclick="nextSlide(event)">></button>
                            <div class="price-tag">₹ 20,000</div>
                            <div class="circles">
                                <div class="circle active"></div>
                                <div class="circle"></div>
                                <div class="circle"></div>
                            </div>
                        </div>
                        <div class="card-property-name">Adani M2K Oyster Grande</div>
                        <div class="card-property-location">Sector-102A, Gurugram</div>
                        <div class="card-amenities">
                            <img src="{{asset('images/home/home-icon.svg')}}">
                            <div>2 BHK</div>
                            <div>2100 sqft.</div>  
                        </div>
                </div>
                <div class="card">
                        <div class="slider">
                            <div class="slider-images">
                                <div class="slide active">
                                    <img src="{{asset('images/home/picture2.png')}}">
                                </div>
                                <div class="slide">
                                    <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                            </div>  
                            <button class="previous" onclick="previousSlide(event)"><</button>
                            <button class="next" onclick="nextSlide(event)">></button>
                            <div class="price-tag">₹ 20,000</div>
                            <div class="circles">
                                <div class="circle active"></div>
                                <div class="circle"></div>
                                <div class="circle"></div>
                            </div>
                        </div>
                        <div class="card-property-name">Adani M2K Oyster Grande</div>
                        <div class="card-property-location">Sector-102A, Gurugram</div>
                        <div class="card-amenities">
                            <img src="{{asset('images/home/home-icon.svg')}}">
                            <div>2 BHK</div>
                            <div>2100 sqft.</div>  
                        </div>
                </div>
                <div class="card">
                        <div class="slider">
                            <div class="slider-images">
                                <div class="slide active">
                                    <img src="{{asset('images/home/picture2.png')}}">
                                </div>
                                <div class="slide">
                                    <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                            </div>  
                            <button class="previous" onclick="previousSlide(event)"><</button>
                            <button class="next" onclick="nextSlide(event)">></button>
                            <div class="price-tag">₹ 20,000</div>
                            <div class="circles">
                                <div class="circle active"></div>
                                <div class="circle"></div>
                                <div class="circle"></div>
                            </div>
                        </div>
                        <div class="card-property-name">Adani M2K Oyster Grande</div>
                        <div class="card-property-location">Sector-102A, Gurugram</div>
                        <div class="card-amenities">
                            <img src="{{asset('images/home/home-icon.svg')}}">
                            <div>2 BHK</div>
                            <div>2100 sqft.</div>  
                        </div>
                </div>
                <div class="card">
                        <div class="slider">
                            <div class="slider-images">
                                <div class="slide active">
                                    <img src="{{asset('images/home/picture2.png')}}">
                                </div>
                                <div class="slide">
                                    <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                            </div>  
                            <button class="previous" onclick="previousSlide(event)"><</button>
                            <button class="next" onclick="nextSlide(event)">></button>
                            <div class="price-tag">₹ 20,000</div>
                            <div class="circles">
                                <div class="circle active"></div>
                                <div class="circle"></div>
                                <div class="circle"></div>
                            </div>
                        </div>
                        <div class="card-property-name">Adani M2K Oyster Grande</div>
                        <div class="card-property-location">Sector-102A, Gurugram</div>
                        <div class="card-amenities">
                            <img src="{{asset('images/home/home-icon.svg')}}">
                            <div>2 BHK</div>
                            <div>2100 sqft.</div>  
                        </div>
                </div>
                <div class="card">
                        <div class="slider">
                            <div class="slider-images">
                                <div class="slide active">
                                    <img src="{{asset('images/home/picture2.png')}}">
                                </div>
                                <div class="slide">
                                    <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.jpg')}}">
                                </div>
                            </div>  
                            <button class="previous" onclick="previousSlide(event)"><</button>
                            <button class="next" onclick="nextSlide(event)">></button>
                            <div class="price-tag">₹ 20,000</div>
                            <div class="circles">
                                <div class="circle active"></div>
                                <div class="circle"></div>
                                <div class="circle"></div>
                            </div>
                        </div>
                        <div class="card-property-name">Adani M2K Oyster Grande</div>
                        <div class="card-property-location">Sector-102A, Gurugram</div>
                        <div class="card-amenities">
                            <img src="{{asset('images/home/home-icon.svg')}}">
                            <div>2 BHK</div>
                            <div>2100 sqft.</div>  
                        </div>
                </div>
            </div>
        </div>
        <div class="go-forward" onclick="scrollRecent(event)">></div>
    </div>

    {{-------------- About Us -------------------------}}
    <div class="home-about">
        <img src="{{asset('images/home/aboutus.svg')}}" class="desktop">
        <img src="{{asset('images/home/mobileabout.svg')}}" class="mobile">
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
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">John Doe, Businessman</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">Sophie Turner, Lawyer</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">Alex Williams, Trader</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">John Doe, Businessman</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">Alex Williams, Trader</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">Sophie Turner, Lawyer</div>
                    </div>
                    <img src="{{asset('images/home/man1.jpg')}}">
                </div>
            </div>
            <img src="{{asset('images/home/test-down-arrow.svg')}}" onclick="scrollDown(event)" />
        </div>
    </div>

@stop