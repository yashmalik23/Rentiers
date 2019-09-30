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