@extends('layout')
@section('views')
    {{--------------- Home Page ------------------}}


    <script type="text/javascript" src="{{asset('js/home.js') }}"></script>

    {{--------------- Headings -------------------}}
    <div class="title-container"> 
        <div class="main-heading">Making Renting Easy</div>
        <div class="main-line">Your rental community platform for lifetime.</div>
        <div class="second-line">Welcome to 21st century renting</div>
    </div>

    {{--------------- Search bar -----------------}}
    <div class="search-container">
        <img src="{{asset('images/home/dot-background.svg')}}" class="dot-background" />
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

    {{---------------- Image at home ------------------}}
    <img src="{{asset('images/home/home.svg')}}" class="main-image"/>

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
                                    <img src="{{asset('images/home/picture.png')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.png')}}">
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
                                    <img src="{{asset('images/home/picture.png')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.png')}}">
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
                                    <img src="{{asset('images/home/picture.png')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.png')}}">
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
                                    <img src="{{asset('images/home/picture.png')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.png')}}">
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
                                    <img src="{{asset('images/home/picture.png')}}">
                                </div>
                                <div class="slide">
                                        <img src="{{asset('images/home/picture.png')}}">
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
                    <img src="{{asset('images/home/man2.svg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">Sophie Turner, Lawyer</div>
                    </div>
                    <img src="{{asset('images/home/girl1.svg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">Alex Williams, Trader</div>
                    </div>
                    <img src="{{asset('images/home/man1.svg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">John Doe, Businessman</div>
                    </div>
                    <img src="{{asset('images/home/man2.svg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">Alex Williams, Trader</div>
                    </div>
                    <img src="{{asset('images/home/man1.svg')}}">
                </div>
                <div class="test-card">
                    <div class="test-text">
                        <div class="testimonial">
                            Thank you very much for the help.It has been a pleasant experience talking with you.  
                        </div>
                        <div class="name">Sophie Turner, Lawyer</div>
                    </div>
                    <img src="{{asset('images/home/girl1.svg')}}">
                </div>
            </div>
            <img src="{{asset('images/home/test-down-arrow.svg')}}" onclick="scrollDown(event)" />
        </div>
    </div>

    {{------------- Confused form --------------}}
    <div class="confuse-form">
        <div class="form-heading">Confused?</div>
        <div class="form-line">Submit a query and we will reply in 24 hours. You are the first priority for us.</div>
        <div class="form-fields">
            <div class="input-field">
                <div class="input-label">Full name *</div>
                <input type="text" required />
            </div>
            <div class="input-field">
                <div class="input-label">Contact number *</div>
                <input type="text" required />
            </div>
            <div class="input-field">
                <div class="input-label">Email Address *</div>
                <input type="text" required />
            </div>
            <div class="input-field">
                <div class="input-label">What are you looking for?</div>
                <input type="text" required />
            </div>
        </div>
        <div class="submit-confuse-form">Submit</div>
    </div> 
@stop