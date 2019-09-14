@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/form.js') }}"></script>
    <div class="list-properties">
        <div class="list-heading">
            List your property with us in 5 simple steps
        </div>
        <div class="list-menu-div">
            <ul class="list-side-menu">
                <li id="list-first-option">
                    <div class="list-number-button"><div>1</div></div>
                    <div class="list-number-title">Basic Details</div>
                </li>
                <li>
                    <img id="first-dotted" src="{{asset('images/listprops/dotted.svg')}}">
                </li>
                <li id="list-second-option">
                    <div class="list-number-button"><div>2</div></div>
                    <div class="list-number-title">Location</div>
                </li>
                <li>
                    <img id="second-dotted" src="{{asset('images/listprops/dotted.svg')}}">
                </li>
                <li id="list-third-option">
                    <div class="list-number-button"><div>3</div></div>
                    <div class="list-number-title">Property Details</div>
                </li>
                <li>
                    <img id="third-dotted" src="{{asset('images/listprops/dotted.svg')}}">
                </li>
                <li id="list-fourth-option">
                    <div class="list-number-button"><div>4</div></div>
                    <div class="list-number-title">Pricing</div>
                </li>
                <li>
                    <img id="fourth-dotted" src="{{asset('images/listprops/dotted.svg')}}">
                </li>
                <li id="list-fifth-option">
                    <div class="list-number-button"><div>5</div></div>
                    <div class="list-number-title">Features</div>
                </li>
            </ul>
            <img class="list-side-menu-line" src="{{asset('images/listprops/line.svg')}}">
        </div>
        <div class="list-property-form">
            <div id="form-1">
                <div class="list-form-heading">Let's get Started!</div>
                <div class="field-inputs">
                    <div class="radio-option-label">You are *</div>
                    <div class="radio-options">
                        <div onclick="changeradio(event)" >
                            <img src="{{asset('images/listprops/radio-full.svg')}}" />
                            <div class="radio-field-name">Owner</div>
                        </div>
                        <div onclick="changeradio(event)" >
                            <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                            <div class="radio-field-name">Builder</div>
                        </div>
                        <div onclick="changeradio(event)" >
                            <img src="{{asset('images/listprops/radio-empty.svg')}}" />
                            <div class="radio-field-name">Broker</div>
                        </div>
                    </div>
                    <div class="line-3">
                        <div class="form-drop-down-options">
                            <div class="drop-down-label">Reason For listing * </div>
                            <div class="drop-down-heading" onclick="showdrop(event)">Select</div>
                            <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                            <ul class="drop-down-list">
                                <li onclick="changeoption(event)">Rent</li>
                                <li onclick="changeoption(event)">Sell</li>
                                <li onclick="changeoption(event)">Paying Guest</li>
                            </ul>
                        </div>
                        <div class="form-drop-down-options">
                            <div class="drop-down-label">Property Type * </div>
                            <div class="drop-down-heading" onclick="showdrop(event)">Select</div>
                            <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                            <ul class="drop-down-list">
                                <li onclick="changeoption(event)">Residential</li>
                                <li onclick="changeoption(event)">Commercial</li>
                            </ul>
                        </div>
                    </div>
                    <div class="line-4">
                            <div class="form-drop-down-options">
                                <div class="drop-down-label">Property * </div>
                                <div class="drop-down-heading" onclick="showdrop(event)">Select</div>
                                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                                <ul class="drop-down-list">
                                    <li onclick="changeoption(event)">Rent</li>
                                    <li onclick="changeoption(event)">Sell</li>
                                    <li onclick="changeoption(event)">Paying Guest</li>
                                </ul>
                            </div>
                            <div class="form-drop-down-options">
                                <div class="drop-down-label">Property Type * </div>
                                <div class="drop-down-heading" onclick="showdrop(event)">Select</div>
                                <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                                <ul class="drop-down-list">
                                    <li onclick="changeoption(event)">Residential</li>
                                    <li onclick="changeoption(event)">Commercial</li>
                                </ul>
                            </div>
                        </div>
                
                    </div>
            </div>
        </div>
        <div class="help-section">
            <div class="help-heading">Help</div>
            <div class="help-line">
                If you are stuck on the form and don't know what to do next, you can email us at support@rentiers.in or call us at +91 9414573503.  
            </div>
            <div class="help-line">
                Get your property verified easily. There are more chances of getting applications if you complete all the form fields.
            </div>
        </div>
    </div>
@stop