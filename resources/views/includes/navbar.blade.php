<nav class="desktop-nav">

    {{-- Desktop Nav bar --}}
    <img class="logo" src="{{asset('images/logo.svg')}}">
    <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">List your property</a></li>
        <li>|</li>
        <li>+91 9414573503</li>
        <li><img class="icons" src="{{asset('images/down-arrow.svg')}}"/></li>
    </ul>
    <div class="login">Login/SignUp</div>
</nav>

<nav class="mobile-nav">
    {{-- Mobile nav bar --}}
    <img class="mobile-menu" src="{{asset('images/menu.svg')}}" onclick="handleMenu()">
    <img class="mobile-logo" src="{{asset('images/logo.svg')}}">
    <div class="side-menu" id="side-nav">
        <ul class="mobile-nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">List your property</a></li>
            <li>+91 9414573503 <img class="icons" src="{{asset('images/down-arrow.svg')}}"/></li>
        </ul>
    </div>
</nav>