@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/user.js') }}"></script>
    @if (isset(Auth::user()->email))
        @if(Auth::user()->email != "inforentier@gmail.com")
        @if(isset($image))
            <div class="alert alert-success" role="alert">
            <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> Image added successfully.
        </div>
        @endif
        @if(isset($delete))
            <div class="alert alert-success" role="alert">
            <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> Property deleted successfully.
        </div>
        @endif
            <div class="user-account">
                <div class="user-properties">
                    @foreach($props as $prop)
                    <div class="property-card" onclick="">
                        @if(count(explode(",", $prop->images))>0 && explode(",",$prop->images)[0] != "" && explode(",",$prop->images)[0] != "noimage.png") 
                        <img class="card-image-circle" src="/storage/{{$prop->id}}/{{explode(",",$prop->images)[0]}}"/>
                        @else
                            <img class="card-image-circle" src="/storage/noimage.png"/>
                        @endif
                        <div class="property-actions">
                        </div>
                        <div class="property-details">
                            <div class="property-title"><a href="/useraccount/{{$prop->id}}">{{$prop->streetName}}</a></div>
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