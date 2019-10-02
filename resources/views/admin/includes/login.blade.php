
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/home/newlogo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script type="text/javascript" src="{{asset('js/admin/main.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Rentiers.in</title>
</head>
<body>
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong>{{session('error')}}
    </div>
    @endif
    @if(isset($timeout))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> Session timeout! Please login again.
    </div>
    @endif
    <div class="container">
        <form class="login-container" method="POST" action="{{ route('tryadminlogin')}}">
            @csrf
            <h1>Admin Login</h1>
            <input type="text" name="email" id="user_name" placeholder="Admin Email" required/><br>
            <input type="password" name="password" id="password" placeholder="Password" required /><br>
            <button >Log In</button>
        </form>
    </div>
</body>
</html>