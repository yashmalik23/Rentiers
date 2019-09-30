@extends('layout')
@section('views')
    @if(session('success'))
    <div class="alert alert-success" role="alert">
    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Success!</strong> Details changed.
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error!</strong> {{session('error')}}.
    </div>
    @endif
        <div class="details-container">
            <form class="detail-form-container" method="POST" action="{{ route('changedetails')}}">
                @csrf
                <h3>Change Details</h3>
                <input type="text" name="email" value="{{Auth::user()->email}}" required/>
                <input type="text" name="name" value="{{Auth::user()->name}}" required/>
                <input type="text" name="contact" value="{{Auth::user()->contact}}" required/>
                <input type="password" name="opassword" id="user_name" placeholder="Current password" required/><br>
                <button>Change</button>
            </form>
            <form class="detail-form-container" method="POST" action="{{ route('changepassword')}}">
                @csrf
                <h3>Change Password</h3>
                <input type="password" name="opassword" id="user_name1" placeholder="Current password" required/><br>
                <input type="password" name="npassword" id="password" placeholder="New Password" required /><br>
                <input type="password" name="cpassword" id="password1" placeholder="Confirm new Password" required /><br>
                <button>Change</button>
            </form>
        </div>                   
@endsection