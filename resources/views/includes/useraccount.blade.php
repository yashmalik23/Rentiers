@extends('layout')
@section('views')
    @if (isset(Auth::user()->email))
        @if(Auth::user()->email != "inforentiers@gmail.com")
            <div class="user-account">
                <div class="user-properties">
                    @foreach($props as $prop)
                    <div class="property-card" onclick="">
                        <img class="card-image-circle" src="{{asset('images/home/picture.png')}}"/>
                        <div class="property-actions">
                            <img class="card-image-edit" src="{{asset('images/viewprops/edit.svg')}}"/>
                            <img class="card-image-cancel" src="{{asset('images/viewprops/close.svg')}}"/>
                        </div>
                        <div class="property-details">
                            <div class="property-title"><a href="useraccount/{{$prop->id}}">{{$prop->nearByArea}}</a></div>
                            <div class="property-address">{{$prop->locality.", ".$prop->city}}</div>
                            <div class="property-interested-numbers">Interested members : 10</div>
                        </div>
                        <div class="property-footer">Details: {{Auth::user()->email}}, {{Auth::user()->contact}}, {{Auth::user()->name}}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

@endsection