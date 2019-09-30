@extends('admin.layout')
@section('admin-view')
    @if(Auth::user() != null)
        @if (Auth::user()->email == "inforentiers@gmail.com")
            <div class="main-layout">
                <!-- nav-bar -->
                <div class="nav-bar">
                    <img src="/images/menu.svg" alt="menu" class="dashboard-icon" onclick="handleMenu()" />
                    <span class="dashboard-heading">Settings</span>
                </div>
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Password changed.
                </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                    <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> {{session('error')}}.
                </div>
                @endif
                <div class="container">
                    <form class="login-container" method="POST" action="{{ route('adminchangepassword')}}">
                        @csrf
                        <h3>Change Password</h3>
                        <input type="password" name="opassword" id="user_name" placeholder="Current password" required/><br>
                        <input type="password" name="npassword" id="password" placeholder="New Password" required /><br>
                        <input type="password" name="cpassword" id="password" placeholder="Confirm new Password" required /><br>
                        <button>Change</button>
                    </form>
                </div>
            </div>
        @else
            <script>window.location.href="/login"</script>
        @endif
    @else
        <script>window.location.href="/login"</script>
    @endif
@endsection