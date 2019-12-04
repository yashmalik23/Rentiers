<!DOCTYPE html>
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
    <script type="text/javascript" src="{{asset('js/navbar.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Your own Property Portal - Rentiers.in</title>
</head>
<body>
    <div class="wrap">
        @include('includes.navbar')
        @if(session('request'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> Request sent! We will call you within 24 hours.
        </div>
        @endif
        @yield('views')
    </div>
    @include('includes/footer')
</body>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148925859-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-148925859-1');
</script>
</html>