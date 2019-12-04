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
                    <div class="view-nearByArea">Adani M2K Oyster Grande</div>
                    <div class="view-locality">Sector-102A, Gurugram</div>
                </div>
                <div class="view-slider">
                    <div class="slider-images">
                        <div class="slide active">
                            <img src="/storage/main/picture0.jpg">
                        </div>
                        <div class="slide">
                            <img src="/storage/main/picture1.jpg">
                        </div>
                        <div class="slide">
                            <img src="/storage/main/picture2.jpg">
                        </div>
                        <div class="slide">
                            <img src="/storage/main/picture3.jpg">
                        </div>
                        <div class="slide">
                            <img src="/storage/main/picture4.jpg">
                        </div>
                    </div>  
                    <button class="previous" onclick="previousSlide(event)" id="view-previous"><</button>
                    <button class="next" onclick="nextSlide(event)" id="view-next">></button>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Basic Details</div>
                    <div class="rest-details-div">
                        <div class="one-feature">
                            <div class="one-feature-heading">Project Type: </div>
                            <div>Residential</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Configurations: </div>
                            <div>3BHKs, 4BHKs and 5 BHKs</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">New booking base price: </div>
                            <div>₹ 95.43 lacs to ₹ 4.81 cr</div>
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Project Details</div>
                    <div class="rest-details-div">
                        <div class="one-feature">
                            <div class="one-feature-heading">Number of towers: </div>
                            <div>8</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Number of floors: </div>
                            <div>21</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Number of units:</div>
                            <div>500</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Total project area:</div>
                            <div>19.23 acres (77.2k sq. m.)</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Open Area:</div>
                            <div>87%</div>
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Phases</div>
                    <div class="rest-details-div">
                        <div class="one-feature">
                            <div class="one-feature-heading">Phase I: </div>
                            <div>Jun 2017,Ready to move, 8 towers (3BHK, 4BHK and 5 BHK) , RERA status (Registered)</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Phase II: </div>
                            <div>Aug 2019,Ready to move, 1 tower (3BHK, 4BHK and 5 BHK) , RERA status (Registered)</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Phase III: </div>
                            <div>Sep 2024,Under construction, 1 tower (3BHK, 4BHK and 5 BHK) , RERA status (Registered)</div>
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Floor plans</div>
                </div>
                <div class="tab-slider">
                    <div class="tabs-header">
                        <div class="tabs active" onclick="changeTab(event,0, '₹93.4 lacs')" >3BHK</div>
                        <div class="tabs" onclick="changeTab(event,1, '₹1.6 crore')">4BHK</div>
                        <div class="tabs" onclick="changeTab(event,2,'₹2.3 crore')">5BHK</div>
                        <div class="tabs" onclick="changeTab(event,3,'₹4 crore')">6BHK</div>
                    </div>
                    <div class="tabs-content">
                        <img class="tabcontent active" src="/storage/main/picture1.jpg" />
                        <img class="tabcontent" src="/storage/main/picture2.jpg" />
                        <img class="tabcontent" src="/storage/main/picture3.jpg" />
                        <img class="tabcontent" src="/storage/main/picture4.jpg" />
                    </div>
                    <div id="tab-price-tag">₹93.4 lacs</div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Locality information</div>
                    <div class="rest-details-div">
                        <div class="one-feature">
                            <div class="one-feature-heading">Oyster Grande in Sector-102 Gurgaon, Gurgaon by Adani M2K Projects LLP is a residential project. The project offers Apartment with perfect combination of contemporary architecture and features to provide comfortable living.</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">The Apartment are of the following configurations: 3BHK, 4BHK and 5BHK. The size of the Apartment ranges in between 156.91 Sq. mt and 676.61 Sq. mt. Oyster Grande price ranges from 92.79 Lacs to 4.80 Cr.</div>
                        </div>
                        <div class="one-feature">
                            <div class="one-feature-heading">Oyster Grande offers facilities such as Gymnasium and Lift. It also has amenities like Badminton court, Basketball court, Lawn tennis court and Swimming pool. It also offers services like Community hall.</div>
                        </div>
                    </div>
                </div>
                <div class="rest-details">
                    <div class="rest-heading">Features</div>
                    <div class="rest-details-div">
                        <div class="svg-feature">
                            <div class="one-feature-heading">Amenities: </div>
                            <div class="svg-icons">
                                <div>
                                    <img src="/images/ameneties/1.svg">
                                    <div>Air conditioners</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/2.svg">
                                    <div>Swimming pool</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/3.svg">
                                    <div>Sports Arena</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/4.svg">
                                    <div>Parks</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/5.svg">
                                    <div>Gym</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/6.svg">
                                    <div>Intercom</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/7.svg">
                                    <div>Lifts</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/8.svg">
                                    <div>Visitor's parking</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/9.svg">
                                    <div>Pet friendly</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/10.svg">
                                    <div>24*7 power backup</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/11.svg">
                                    <div>Wheelchair friendly</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/12.svg">
                                    <div>Gated society</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/13.svg">
                                    <div>24*7 water</div>
                                </div>
                                <div>
                                    <img src="/images/ameneties/14.svg">
                                    <div>Mini theatrer</div>
                                </div>
                            </div>
                        </div>
                        <div class="more-feature">
                            <span class="one-feature-heading">Lifestyle: </span>
                            <div>Aerobics</div>
                            <div>Badminton</div>
                            <div>Basketball</div>
                            <div>Cricket</div>
                        </div>
                        <div class="more-feature">
                            <span class="one-feature-heading">Security: </span>
                            <div>24*7 security</div>
                            <div>CCTV camera</div>
                            <div>Changing area</div>
                            <div>Gated society</div>
                            <div>Property staff</div>
                            <div>Security cabin</div>
                        </div>
                        <div class="more-feature">
                            <span class="one-feature-heading">Services: </span>
                            <div>ATM</div>
                            <div>Cafeteria</div>
                            <div>Salon</div>
                            <div>Shopping centre</div>
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
                                        <div class="slide active">
                                            <img src="/storage/main/picture1.jpg">
                                        </div>
                                        <div class="slide">
                                            <img src="/storage/main/picture2.jpg">
                                        </div>
                                        <div class="slide">
                                            <img src="/storage/main/picture2.jpg">
                                        </div>
                                    </div>  
                                    <button class="previous" onclick="previousSlide(event)"><</button>
                                    <button class="next" onclick="nextSlide(event)">></button>
                                </div>
                                <div class="card-property-name"><a href="/property/" >Adani M2K Oyster Grande</a></div>
                                <div class="card-property-location">Sector 102A, Gurugram</div>
                                <div class="card-amenities">
                                    <img src="{{asset('images/home/home-icon.svg')}}"/>
                                    <div>3BHK, 4BHK and 5BHKs</div>
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