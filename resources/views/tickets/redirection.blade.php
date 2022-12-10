@extends('templates.layout')

@section('content')
    <x-main-title>Przekazywanie sprawy</x-main-title>

    <main class="redirect-ticket">

        <p>Temat:</p>
        <p>{{$ticket->title}}</p>

        <p>Termin:</p>
        <p>{{$ticket->deadline}}</p>

        <p>Priorytet: </p>
        <p>{{$ticket->priority}}</p>

        <x-redirect-form :$ticket :$users></x-redirect-form>

    </main>

@endsection
