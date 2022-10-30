<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>

@include('partials._navbar')

<div class="header">


  
  <div class="header__logged-user">Mikołaj Rej</div>
  <div class="header__largefont"><i class="fa-solid fa-a fa-3x"></i></div>
  <div class="header__smallfont"><i class="fa-solid fa-a fa-2xs"></i></div>
  <div class="header__contrast"><i class="fa-solid fa-circle-half-stroke fa-3x"></i></div>
</div>
<div class="main">

    @yield('content')

</div>
</body>
</html>
