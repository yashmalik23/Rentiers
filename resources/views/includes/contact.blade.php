@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/contact.js') }}"></script>
    <div class="contact-us">
        <div class="contact-heading">Feel free to contact us</div>
        <div class="contact-us-div">
            <img class="left-contact-image" src="{{asset('images/contactus/main.svg')}}">
            <form class="contact-form" method="POST" action="requests">
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
                <div class="contact-submit" onclick="contactSubmit()">Submit</div>
                <button type="submit" id="contact-button">
            </form>
        </div>
        <div class="last-line">We will reply within 24 hours. Our customers values the most for us</div> 
    </div> 
@stop