@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/view.js') }}"></script>
    <div class="view-property">
            <div class="view-slider">
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
                <button class="previous" onclick="previousSlide(event)" id="view-previous"><</button>
                <button class="next" onclick="nextSlide(event)" id="view-next">></button>
                <div class="circles">
                    <div class="circle active"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
            </div>
        @foreach ($props as $prop)
            {{$prop->locality}}
        @endforeach
    </div>
@endsection