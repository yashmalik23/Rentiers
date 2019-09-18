@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/search.js') }}"></script>
    <div class="search-section">
        {{--------------- Search bar -----------------}}
        <div class="search-result-container">
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

    </div>
@endsection