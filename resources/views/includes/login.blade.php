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
{{session('error')}}
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
@if(session('new'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Success!</strong> {{session('new')}}.
</div>
@endif
    <script type="text/javascript" src="{{asset('js/login.js') }}"></script>
    <div class="login-page">
        <div class="login-heading">Get started with us!</div>
        <div class="signup-div">
            <img class="left-login-image" src="{{asset('images/login/main.svg')}}">
            <form class="signup-form" method="POST" action="register">
                @csrf
                <div class="signup1">
                    <div class="input-field">
                        <div class="input-label">Full name *</div>
                        <input type="text" required name="name"/>
                    </div>
                    <div class="input-field-1">
                        <div class="input-label">Contact Number*</div>
                        <input type="text" id="code" name="code" required value="+91"/>
                        <input type="number" id="number" required name="contact"/>
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
                    <div class="signup-options">
                        <div class="login-member" onclick="changeForm()" >LOG IN?</div>
                    </div>
                    <div class="signup-submit" onclick="checkMobile()" >Sign Up</div>
                    <div class="loader" id="loader">
                        <div class="spinner spinner-1">
                        </div>
                    </div>
                </div>
                <div class="signup2">
                    <div class="input-field">
                        <div class="input-label">Enter OTP *</div>
                        <input type="number" id="otp-sent" required name="otp"/>
                    </div>
                    <div class="signup-submit" onclick="registerUser()" >Verify</div>
                </div>
                <button type="submit" id="register-button"></button>
            </form>
            <form class="login-form" method="POST" action="login">
                @csrf
                <div class="input-field-1">
                    <div class="input-label">Contact Number*</div>
                    <input type="text" id="code1" name ="code" required value="+91"/>
                    <input type="number" required name="contact"/>
                </div>
                <div class="input-field">
                    <div class="input-label">Password *</div>
                    <input type="password" required name="password"/>
                </div>
                <div class="signup-options">
                    <div class="login-member" onclick="changeForm()">SIGN UP?</div>
                    <div class="login-member" onclick="emailPassword()">Forget password? </div>
                </div>
                <div class="login-submit" onclick="checkLogin()">Log In</div>
                <button type="submit" id="login-button"></button>
            </form>
            <form class="mobile-form" method="POST" action="reset">
                @csrf
                <div class="input-field">
                    <div class="input-label">Email Address *</div>
                    <input type="email" required name="email"/>
                </div>
                <div class="signup-options">
                    <div class="login-member" onclick="backToLogin()">Log In? </div>
                    <div class="login-member"  style="color:black;font-size:1.2rem;">New password will be sent to registered email. Don't forget to check your spam folder</div>
                </div>
                <div class="login-submit" onclick="sendMail()">Send</div>
                <button type="submit" id="mobile-button"></button>
            </form>
        </div>
        <div class="frontalert alert-danger" id="frontalert">
            Wrong details
        </div>
    </div>
@stop