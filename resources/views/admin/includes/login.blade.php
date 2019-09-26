<link rel="stylesheet" href="{{asset('css/app.css')}}">
<div class="container">
    <form class="login-container" method="POST" action="{{ route('tryadminlogin')}}">
        @csrf
        <h1>Admin Login</h1>
        <input type="text" name="email" id="user_name" placeholder="Admin Email" required/><br>
        <input type="password" name="password" id="password" placeholder="Password" required /><br>
        <button >Log In</button>
    </form>
</div>