@extends('layout')
@section('views')
    <div class="about-us">
        <div class="about-heading">About Us</div>
        <div class="about-us-div">
            <img src="{{asset('images/aboutus/main.svg')}}" class="about-us-image">
            <div class="about-text">
                Our mission is to help everyone to find their place in the world. 
                Rentiers.in is the modern real estate platform. We have aimed to simplify the real estate process, 
                targeting one market at a time. With our team and their efforts, we are dedicated to serve you for 
                your dream's house. There's no better feeling than handing our customers the key to their house.
            </div>
        </div>
        {{------------- Work form --------------}}
        <div class="confuse-form">
            <div class="form-heading">Work with Us</div>
            <div class="form-line">Submit a query and we will reply in 24 hours. You are the first priority for us.</div>
            <div class="form-fields">
                <div class="input-field">
                    <div class="input-label">Full name *</div>
                    <input type="text" required />
                </div>
                <div class="input-field">
                    <div class="input-label">Contact number *</div>
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
            </div>
            <div class="submit-confuse-form">Submit</div>
        </div> 
    </div> 
@stop