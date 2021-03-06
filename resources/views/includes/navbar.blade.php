<nav class="desktop-nav">

    {{-- Desktop Nav bar --}}
    {{-- <img class="logo" src="{{asset('images/navbar/logo.png')}}" onclick="function c(){window.location.href= '/'}; c()"> --}}
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('aboutus') }}">About Us</a></li>
        <li><a href="{{ route('contactus') }}">Contact Us</a></li>
        <li><a href="{{ route('allprojects') }}">All projects</a></li>
        <li>|</li>
        <li>+91 8860050003</li>
        <li>
            <span onclick="viewContacts(event)" style="cursor:pointer; user-select:none;">▼</span>
            <ul class="contact-numbers">
                <li>+91 8860050004</li>
                <li>+91 8860050006</li>
            </ul>
        </li>
    </ul>
    @if (isset(Auth::user()->email))
        <div class="user-name"><a href="{{ route('useraccount') }}"> {{str_split(Auth::user()->name)[0]}}</a></div>
        <div class="login"><a href="{{ route('listproperties') }}">List property</a></div>
        <div class="login"><a href="{{ route('logout') }}">Log Out</a></div>
    @else
    <div class="login"><a href="{{ route('listproperties') }}">List property</a></div>
    <div class="login"><a href="{{ route('login') }}">Login/SignUp</a></div>
    @endif
</nav>

<nav class="mobile-nav">
    {{-- Mobile nav bar --}}
    <div class="man-layout">
        <img class="mobile-menu" src="{{asset('images/navbar/menu.svg')}}" onclick="handleMenu()">
        {{-- <img class="mobile-logo" src="{{asset('images/navbar/logo.png')}}" onclick="function c(){window.location.href= '/'}; c()"> --}}
        <div class="contact-main">
            <span class="contact-mobile">+91 8860050003</span> 
            <span onclick="viewContacts(event)">▼</span>
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
        <li><a href="{{ route('allprojects') }}">All projects</a></li>
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
