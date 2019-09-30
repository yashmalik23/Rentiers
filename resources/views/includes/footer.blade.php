<div class="request-div">
    <div>Reach us</div>
    <a target="_blank" href=""><img src="{{asset('images/footer/instagram.svg')}}" id='footer-chat-image'></a>
    <a target="_blank" href="https://www.facebook.com/rentiersgroup"><img src="{{asset('images/footer/facebook.svg')}}" id='footer-chat-image'></a>
    <img src="{{asset('images/footer/chat.svg')}}" id='footer-chat-image' onclick="togglechat(event)">
    <form class="request-footer-form" method="POST" action="{{ route('requests') }}">
        <span>Call us @+91 8860050003/4/6 or we will call you</span>
        @csrf
        <div class="input-field">
            <div class="input-label">Full name *</div>
            <input type="text" required name="name"/>
        </div>
        <div class="input-field">
            <div class="input-label">Contact Number*</div>
            <input type="text" required name="contact"/>
        </div>
        <div class="input-field">
            <div class="input-label">Email Address *</div>
            <input type="text" required name="email"/>
        </div>
        <div class="input-field">
            <div class="input-label">What are you looking for?</div>
            <input type="text" name="request"/>
        </div>
        <div class="footer-submit" onclick="footerSubmit()">Submit</div>
        <button type="submit" id="footer-button">
    </form>
</div>
<footer>
    <img class="footer-left" src="{{asset('images/footer/footer-left.svg')}}">
    <ul class="footer-link-columns">
        <li>Rental Properties</li>
        <li><a href="/property/3">Adani M2K Oyster Grande</a></li>
        <li><a href="/property/3">Godrej Summit</a></li>
        <li><a href="/property/3">The Meridion</a></li>
        <li><a href="/property/3">Rental floor in house</a></li>
        <li><a href="/property/3">Independent floor</a></li>
    </ul>
    <ul class="footer-link-columns">
        <li>Buy Properties</li>
        <li><a href="/property/3">Adani M2K Oyster Grande</a></li>
        <li><a href="/property/3">Godrej Summit</a></li>
        <li><a href="/property/3">The Meridion</a></li>
        <li><a href="/property/3">Rental floor in house</a></li>
        <li><a href="/property/3">Independent floor</a></li>
    </ul>
    <ul class="footer-link-columns">
        <li>Quick links</li>
        <li><a href="/aboutus">About Us</a></li>
        <li><a href="/contactus">Contact Us</a></li>
        <li><a href="/listproperties">List property</a></li>
        <li><a href="/">Home</a></li>
        <li><a href="/search">Search</a></li>
    </ul>
    <div class="copyright"> Copyright © 2019 by Rentiers.in, Gurugram, Haryana, India</div>
    <img class="footer-right" src="{{asset('images/footer/footer-right.svg')}}">
</footer>