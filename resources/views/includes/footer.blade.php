<footer>
    <div class="request-div">
        <div>Contact us</div>
        <img src="{{asset('images/navbar/chat.svg')}}" id='footer-chat-image' onclick="togglechat(event)">
        <form class="request-footer-form" method="POST" action="requests">
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
    <img class="footer-left" src="{{asset('images/footer/footer-left.svg')}}">
    <ul class="footer-link-columns">
        <li>Recent Properties</li>
        <li>Adani M2K Oyster Grande</li>
        <li>Godrej Summut</li>
        <li>The Meridion</li>
        <li>Rental floor in house</li>
        <li>Independent floor</li>
    </ul>
    <ul class="footer-link-columns">
        <li>Recent Properties</li>
        <li>Adani M2K Oyster Grande</li>
        <li>Godrej Summut</li>
        <li>The Meridion</li>
        <li>Rental floor in house</li>
        <li>Independent floor</li>
    </ul>
    <ul class="footer-link-columns">
        <li>Recent Properties</li>
        <li>Adani M2K Oyster Grande</li>
        <li>Godrej Summut</li>
        <li>The Meridion</li>
        <li>Rental floor in house</li>
        <li>Independent floor</li>
    </ul>
    <div class="copyright"> Copyright © 2019 by Rentiers.in, Gurugram, Haryana, India</div>
    <img class="footer-right" src="{{asset('images/footer/footer-right.svg')}}">
</footer>