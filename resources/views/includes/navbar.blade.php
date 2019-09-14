<nav class="desktop-nav">

    {{-- Desktop Nav bar --}}
    <img class="logo" src="{{asset('images/navbar/logo.svg')}}">
    <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="aboutus">About Us</a></li>
        <li><a href="contactus">Contact Us</a></li>
        <li><a href="listproperties">List your property</a></li>
        <li>|</li>
        <li>+91 9414573503</li>
        <li>
            <img class="icons" src="{{asset('images/navbar/down-arrow.svg')}}"/>
            <ul class="contact-numbers">
                <li>+91 8683803539</li>
                <li>+91 7901763826</li>
            </ul>
        </li>
    </ul>
    <div class="login">Login/SignUp</div>
</nav>

<nav class="mobile-nav">
    {{-- Mobile nav bar --}}
    <div class="main-layout">
        <img class="mobile-menu" src="{{asset('images/navbar/menu.svg')}}" onclick="handleMenu()">
        <img class="mobile-logo" src="{{asset('images/navbar/logo.svg')}}">
    </div>
    <ul class="mobile-nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">List your property</a></li>
        <li>+91 9414573503&nbsp;&nbsp;<img class="icons" src="{{asset('images/navbar/white-down-arrow.svg')}}"/></li>
        <li><div class="mobile-login">Login/SignUp</div></li>
    </ul>
</nav>