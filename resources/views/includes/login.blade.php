@extends('layout')
@section('views')
    <script type="text/javascript" src="{{asset('js/login.js') }}"></script>
    <div class="login-page">
        <div class="login-heading">Get started with us!</div>
        <div class="signup-div">
            <img class="left-login-image" src="{{asset('images/login/main.svg')}}">
            <div class="signup-form">
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
                    <div class="input-label">Password *</div>
                    <input type="text" required />
                </div>
                <div class="input-field">
                    <div class="input-label">Confirm password *</div>
                    <input type="text" required />
                </div>
                <div class="input-field">
                    <div class="input-label">Sign up as *</div>
                    <input type="text" placeholder="Member/Seller" required />
                </div>
                <div class="signup-options">
                    <div class="login-form-check-field" id="rememberMe">
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" id="signup-remember"/>
                            <div class="check-option-value">Remember Me</div>
                        </div>
                    </div>
                    <div class="login-member" onclick="changeForm()" >Already a member? Log in</div>
                </div>
                <div class="signup-submit">Sign Up</div>
            </div>
            <div class="login-form">
                <div class="input-field">
                    <div class="input-label">Email Address *</div>
                    <input type="text" required />
                </div>
                <div class="input-field">
                    <div class="input-label">Password *</div>
                    <input type="text" required />
                </div>
                <div class="signup-options">
                    <div class="login-form-check-field" id="rememberMe">
                        <div class="check-option">
                            <img src="{{asset('images/listprops/unchecked.svg')}}" class="check-image" onclick="changecheck(event)" id="login-remember"/>
                            <div class="check-option-value">Remember Me</div>
                        </div>
                    </div>
                    <div class="login-member" onclick="changeForm()">Not a member? Sign Up</div>
                </div>
                <div class="login-submit">Log In</div>
            </div>
        </div>
    </div>
@stop