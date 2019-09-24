<nav class="desktop-nav">

    {{-- Desktop Nav bar --}}
    <img class="logo" src="{{asset('images/navbar/logo.png')}}">
    <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="aboutus">About Us</a></li>
        <li><a href="contactus">Contact Us</a></li>
        <li><a href="listproperties">List your property</a></li>
        <li>|</li>
        <li>+91 9414573503</li>
        <li>
            <img class="icons" src="{{asset('images/navbar/down-arrow.svg')}}" onclick="viewContacts(event)"/>
            <ul class="contact-numbers">
                <li>+91 8683803539</li>
                <li>+91 7901763826</li>
            </ul>
        </li>
    </ul>
    @if (isset(Auth::user()->email))
        <div class="user-name"><a href="useraccount"> {{Auth::user()->name}}</a></div>
        <div class="login"><a href="logout">Log Out</a></div>
    @else
    <div class="login"><a href="login">Login/SignUp</a></div>
    @endif
</nav>

<nav class="mobile-nav">
    {{-- Mobile nav bar --}}
    <div class="main-layout">
        <img class="mobile-menu" src="{{asset('images/navbar/menu.svg')}}" onclick="handleMenu()">
        <img class="mobile-logo" src="{{asset('images/navbar/logo.png')}}">
    </div>
    <ul class="mobile-nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="aboutus">About Us</a></li>
        <li><a href="contactus">Contact Us</a></li>
        <li><a href="listproperties">List your property</a></li>
        <li>+91 9414573503</li>
        <li>+91 8683803539</li>
        <li>+91 7901763826</li>
        @if (isset(Auth::user()->email))
            <li><a href="useraccount"> {{Auth::user()->name}}</a></li>
            <li><div class="mobile-login"><a href="logout">Log Out</a></div></li>
        @else
            <li><div class="mobile-login"><a href="login">Login/SignUp</a></div></li>
        @endif
    </ul>
</nav>