@extends('layout')
@section('views')
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-auth.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyCQ0FIb8oJCycQbiAEq0QhPC08zdsrI0tk",
    authDomain: "rentiers-104ee.firebaseapp.com",
    databaseURL: "https://rentiers-104ee.firebaseio.com",
    projectId: "rentiers-104ee",
    storageBucket: "rentiers-104ee.appspot.com",
    messagingSenderId: "15760571105",
    appId: "1:15760571105:web:e1400e391a3cfa3fcb55a0",
    measurementId: "G-XE5NHRPKBC"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
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
                    <div class="login-member" onclick="changeMobileForm()">Use mobile number instead?</div>
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
                    <div class="login-member" onclick="changeMobileForm()">Use mobile number instead?</div>
                </div>
                <div class="login-submit" onclick="checkLogin()">Log In</div>
                <button type="submit" id="login-button"></button>
            </form>
            <form class="mobile-form" method="POST" action="{{ route('usemobile')}}">
                @csrf
                <div class="input-field" id="mobile-1">
                    <div class="input-label">Mobile number *</div>
                    <input type="number" required name="mobile" id="mobile-number"/>
                </div>
                <div class="input-field" id="mobile-2" style="display:none">
                    <div class="input-label">Enter OTP *</div>
                    <input type="number" required name="otp" id="otp-sent"/>
                </div>
                <div class="signup-options">
                    <div class="login-member" onclick="changeNormal()">Use email instead?</div>
                </div>
                <div class="mobile-submit" id="mobile-submit" onclick="checkMobile()">Send OTP</div>
                <div class="mobile-submit" id="mobile-submit-2" onclick="verifyMobile()" style="width:100px;display:none;">Verify</div>
                <button type="submit" id="mobile-button"></button>
            </form>
        </div>
    </div>
@stop