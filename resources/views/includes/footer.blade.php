<div class="request-div">
    <div>Reach us</div>
    <a target="_blank" href="https://www.instagram.com/rentiers.in/"><img src="{{asset('images/footer/instagram.svg')}}" id='footer-chat-image'></a>
    <a target="_blank" href="https://www.facebook.com/rentiersgroup"><img src="{{asset('images/footer/facebook.svg')}}" id='footer-chat-image'></a>
    <a target="_blank" href="https://twitter.com/RentiersGroup"><img src="{{asset('images/footer/twitter.svg')}}" id='footer-chat-image'></a>
    <img src="{{asset('images/footer/chat.svg')}}" id='footer-chat-image' onclick="togglechat(event)">
    <form class="request-footer-form" method="POST" action="{{ route('requests') }}">
        <div class="request-title">Call us @+91 8860050003/4/6 from 10AM-7PM IST or we will call you</div>
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
        <li><a href="/property/16" target="_blank">Tata Gurgaon Gateway</a></li>
        <li><a href="/property/6" target="_blank">Adani M2K Oyster Grande</a></li>
        <li><a href="/property/11" target="_blank">Raheja Atharva</a></li>
        <li><a href="/property/13" target="_blank">Puri Emerald Bay</a></li>
        <li><a href="/property/15" target="_blank">Experion The Heartsong</a></li>
    </ul>
    <ul class="footer-link-columns">
        <li>Buy Properties</li>
        <li><a href="/property/19" target="_blank">Adani M2K Oyster Grande</a></li>
        <li><a href="/property/20" target="_blank">Adani M2K Oyster Grande</a></li>
        <li><a href="/property/21" target="_blank">Adani M2K Oyster Grande</a></li>
        <li><a href="/property/22" target="_blank">Godrej Summit</a></li>
        <li><a href="/property/22" target="_blank">Godrej Summit</a></li>
    </ul>
    <ul class="footer-link-columns">
        <li>Quick links</li>
        <li><a href="/aboutus" target="_blank">About Us</a></li>
        <li><a href="/contactus" target="_blank">Contact Us</a></li>
        <li><a href="/listproperties" target="_blank">List property</a></li>
        <li><a href="/" >Home</a></li>
        <li><a href="/search">Search</a></li>
    </ul>
    <div class="copyright"> Copyright © 2019 by Rentiers.in, Gurugram, Haryana, India</div>
    <img class="footer-right" src="{{asset('images/footer/footer-right.svg')}}">
</footer>