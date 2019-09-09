@extends('layout')
@section('views')
    <div class="contact-us">
        <div class="contact-heading">Feel free to contact us</div>
        <div class="contact-us-div">
            <img class="left-contact-image" src="{{asset('images/contactus/main.svg')}}">
            <div class="contact-form">
                <div class="input-field">
                    <div class="input-label">Full name *</div>
                    <input type="text" required />
                </div>
                <div class="input-field">
                    <div class="input-label">Contact Number*</div>
                    <input type="text" required />
                </div>
                <div class="input-field">
                    <div class="input-label">Email Address *</div>
                    <input type="text" required />
                </div>
                <div class="input-field">
                    <div class="input-label">What are you looking for?</div>
                    <input type="text" required />
                </div>
                <div class="contact-submit">Submit</div>
            </div>
        </div>
        <div class="last-line">We will reply within 24 hours. Our customers values the most for us</div> 
    </div> 
@stop