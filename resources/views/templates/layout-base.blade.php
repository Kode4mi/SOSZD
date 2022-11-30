<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

{{--    Sprawdzanie czy Aplikacja jest włączona w wersji mobilnej w js i php - chwilowo tak nie poukładane --}}

    <script>
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
    </script>

    <?php
    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    ?>


    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
    @if(!isMobile())
        <script src="{{ asset('js/main.js') }}"></script>
    @endif
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>



@yield('cont')

@include('partials._message')

</body>
</html>
