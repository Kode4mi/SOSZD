@extends('templates.layout')

@section('content')
    <x-main-title>Przekazywanie sprawy</x-main-title>

    <main class="main-window redirect">
        <div class="redirect__info">
            <p>Temat: {{$ticket->title}}</p>
            <hr>
            <p>Termin: {{$ticket->deadline}}</p>
            <hr>
            <p>Priorytet: {{$ticket->priority}}</p>
            <hr>
        </div>
        <x-redirect-form :$ticket :$users></x-redirect-form>
    </main>

@endsection
