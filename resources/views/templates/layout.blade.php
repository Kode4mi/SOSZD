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
    <div class="navbar">
    <div class="navbar__logo">
    <span class="navbar__nazwa_1">so</span><span class="navbar__nazwa_2">SZD</span>
    </div>
    <div class="navbar__sidebar"> 
       <p> <input type="button" value="Aktualności" class="navbar__sidebar--button navbar__sidebar--button1" />   </p>
       <p> <input type="button" value="Nowa Sprawa"  class="navbar__sidebar--button" />  </p>
       <p> <input type="button" value="Użytkownicy"  class="navbar__sidebar--button" />  </p>
       <p> <input type="button" value="Wyloguj"  class="navbar__sidebar--button" />      </p>
    </div>
    </div>
    <div class="header"></div>
    <div class="main"></div>

<div>
    @yield('content')
</div>
</body>
</html>
