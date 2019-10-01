<nav class="desktop-nav">

    {{-- Desktop Nav bar --}}
    <img class="logo" src="{{asset('images/navbar/logo.png')}}" onclick="function c(){window.location.href= '/'}; c()">
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('aboutus') }}">About Us</a></li>
        <li><a href="{{ route('contactus') }}">Contact Us</a></li>
        <li><a href="{{ route('listproperties') }}">List your property</a></li>
        <li>|</li>
        <li>+91 8860050003</li>
        <li>
            <img class="icons" src="{{asset('images/navbar/down-arrow.svg')}}" onclick="viewContacts(event)"/>
            <ul class="contact-numbers">
                <li>+91 8860050004</li>
                <li>+91 8860050006</li>
            </ul>
        </li>
    </ul>
    @if (isset(Auth::user()->email))
        <div class="user-name"><a href="{{ route('useraccount') }}"> {{Auth::user()->name}}</a></div>
        <div class="login"><a href="{{ route('logout') }}">Log Out</a></div>
    @else
    <div class="login"><a href="{{ route('login') }}">Login/SignUp</a></div>
    @endif
</nav>

<nav class="mobile-nav">
    {{-- Mobile nav bar --}}
    <div class="man-layout">
        <img class="mobile-menu" src="{{asset('images/navbar/menu.svg')}}" onclick="handleMenu()">
        <img class="mobile-logo" src="{{asset('images/navbar/logo.png')}}" onclick="function c(){window.location.href= '/'}; c()">
        <div class="contact-main">
            <span class="contact-mobile">+91 8860050003</span> 
            <img class="icons" src="{{asset('images/navbar/down-arrow.svg')}}" onclick="viewContacts(event)"/>
            <ul class="contact-numbers">
                <li>+91 8860050004</li>
                <li>+91 8860050006</li>
            </ul>
        </div>
    </div>
    <ul class="mobile-nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('aboutus') }}">About Us</a></li>
        <li><a href="{{ route('contactus') }}">Contact Us</a></li>
        <li><a href="{{ route('listproperties') }}">List your property</a></li>
        @if (isset(Auth::user()->email))
            <li><a href="{{ route('useraccount') }}"> {{Auth::user()->name}}</a></li>
            <li><div class="mobile-login"><a href="{{ route('logout') }}">Log Out</a></div></li>
        @else
            <li><div class="mobile-login"><a href="{{ route('login') }}">Login/SignUp</a></div></li>
        @endif
    </ul>
</nav>
<script>
(function($){
  $(document).on('contextmenu', 'img', function() {
      return false;
  })
})(jQuery);
</script>
