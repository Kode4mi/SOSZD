@extends('templates.layout-base')

@section('cont')

@include('partials._navbar')
@include('partials._header')

<div class="main" id="main">


    @yield('content')

</div>

@endsection
