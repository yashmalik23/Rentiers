@extends('layout')
@section('views')
@if ($msg = Session::get('error'))
{{ $msg }}
@endif 
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
                <div class="input-field">
                    <div class="input-label">Sign up as *</div>
                    <input type="text" placeholder="Member/Seller" required name="signupas"/>
                </div>
                <input type="checkbox" name="rememberme" style="display:none"/>
                <div class="signup-options">
                    <div class="login-form-check-field" id="rememberMe">
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" id="signup-remember"/>
                            <div class="check-option-value">Remember Me</div>
                        </div>
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
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" id="login-remember"/>
                            <div class="check-option-value">Remember Me</div>
                        </div>
                    </div>
                    <div class="login-member" onclick="changeForm()">Not a member? Sign Up</div>
                </div>
                <div class="login-submit" onclick="checkLogin()">Log In</div>
                <button type="submit" id="login-button"></button>
            </form>
        </div>
    </div>
@stop