@extends('layout')
@section('views')
    <div class="user-account">
        <div class="user-properties">
            @foreach($props as $prop)
                <div class="property-card" style="height:150px">
                    @if(count(explode(",", $prop->images))>0 && explode(",",$prop->images)[0] != "" && explode(",",$prop->images)[0] != "noimage.png") 
                        <img class="card-image-circle" src="/storage/projects/{{$prop->id}}/{{explode(",",$prop->images)[0]}}"/>
                    @else
                        <img class="card-image-circle" src="/storage/noimage.png"/>
                    @endif
                    <div class="property-details">
                        <div class="property-title"><a href="/viewproject/{{$prop->id}}">{{$prop->projectName}}</a></div>
                        <div class="property-address" style="font-weight:bold;font-size:1.5rem; margin-bottom:15px;">{{$prop->streetName.", ".$prop->city}}</div>
                        <div class="property-interested-numbers">Base price : ₹ {{$prop->basePrice}}</div>
                        <div class="property-interested-numbers">Configurations : {{$prop->configurations}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection