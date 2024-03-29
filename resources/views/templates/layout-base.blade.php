<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">

    <script src="{{ asset('js/app.js') }}"></script>
    @if(!\App\Http\Controllers\Controller::isMobile())
        <script src="{{ asset('js/desktop.js') }}"></script>
    @endif
    <script src="{{ asset('js/main.js') }}" defer></script>

</head>
<body>



@yield('cont')

@include('partials._message')

</body>
</html>
