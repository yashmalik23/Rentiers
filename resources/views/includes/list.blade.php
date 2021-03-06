@extends('layout')
@section('views')
    @if(Auth::user() == null)
        <script>window.location.href="/login"</script>
    @endif
    @if(session('property'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success!</strong> Property listed.
    </div>
    @endif
    <script type="text/javascript" src="{{asset('js/listProps/validate.js') }}"></script>
    <div class="list-properties">
        <div class="list-heading">
            List your property with us in 5 simple steps
        </div>
        <div class="list-menu-div">
            <ul class="list-side-menu">
                <li id="list-first-option" class="active-list-menu">
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
        <form class="list-property-form" method="POST" action="listprops">
            @csrf
            @include('includes/listforms/basicDetails')
            @include('includes/listforms/location')
            @include('includes/listforms/moreDetails')
            @include('includes/listforms/pricing')
            @include('includes/listforms/features')
        <button type="submit" id="property-submit" ></button>
        </form>
        <div class="help-section">
            <div class="help-heading">Help</div>
            <div class="help-line-1">
                If you are stuck on the form and don't know what to do next, you can email us at support@rentiers.in or call us at +91 8860050003/4/6.  
            </div>
            <div class="help-line-2">
                Get your property verified easily. There are more chances of getting applications if you complete all the form fields.
            </div>
            <div class="frontalert alert-danger" id="frontalert">
                Wrong details
            </div>
            <div class="continue-list-button" onclick="validateforms()">Continue</div>
        </div>
    </div>
@stop