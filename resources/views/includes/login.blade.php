@extends('layout')
@section('views')
@if(session('error'))
<div class="alert alert-danger" role="alert">
    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error!</strong> Login failed! Email already exists or details are incorrect.
</div>
@endif
@if(session('message'))
<div class="alert alert-danger" role="alert">
    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error!</strong> {{session('message')}}.
</div>
@endif
<div class="frontalert alert-danger" id="frontalert">
    Wrong details
</div>
    <script type="text/javascript" src="{{asset('js/login.js') }}"></script>
    <div class="login-page">
        <div class="login-heading">Get started with us!</div>
        <div class="signup-div">
            <img class="left-login-image" src="{{asset('images/login/main.svg')}}">
            <form class="signup-form" method="POST" action="register">
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
                    <input type="email" required name="email"/>
                </div>
                <div class="input-field">
                    <div class="input-label">Password *</div>
                    <input type="password" required name="password" />
                </div>
                <div class="input-field">
                    <div class="input-label">Confirm password *</div>
                    <input type="password" required name="password_confirmation"/>
                </div>
                <div class="form-drop-down-options">
                    <div class="drop-down-label">Sign Up as * </div>
                    <div class="drop-down-heading" onclick="showdrop(event)" id="membercheck">Select</div>
                    <img src="{{asset('images/navbar/down-arrow.svg')}}" />
                    <ul class="drop-down-list">
                        <li onclick="changeoption(event)">Member</li>
                        <li onclick="changeoption(event)">Seller</li>
                    </ul>
                </div>
                <input name="signupas" type="text" hidden>
                <input type="checkbox" name="rememberme" style="display:none"/>
                <div class="signup-options">
                    <div class="login-form-check-field" id="rememberMe">
                        {{-- <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" id="signup-remember"/>
                            <div class="check-option-value">Remember Me</div>
                        </div> --}}
                    </div>
                    <div class="login-member" onclick="changeForm()" >Already a member? Log in</div>
                </div>
                <div class="signup-submit" onclick="registerUser()" >Sign Up</div>
                <button type="submit" id="register-button"></button>
            </form>
            <form class="login-form" method="POST" action="login">
                @csrf
                <div class="input-field">
                    <div class="input-label">Email Address *</div>
                    <input type="email" required name="email"/>
                </div>
                <div class="input-field">
                    <div class="input-label">Password *</div>
                    <input type="password" required name="password"/>
                </div>
                <input type="checkbox" name="rememberme" style="display:none"/>
                <div class="signup-options">
                    <div class="login-form-check-field" id="rememberMe">
                        {{-- <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" id="login-remember"/>
                            <div class="check-option-value">Remember Me</div>
                        </div> --}}
                    </div>
                    <div class="login-member" onclick="changeForm()">Not a member? Sign Up</div>
                </div>
                <div class="login-submit" onclick="checkLogin()">Log In</div>
                <button type="submit" id="login-button"></button>
            </form>
        </div>
    </div>
@stop