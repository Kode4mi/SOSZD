@extends('templates.layout')

@section('content')
    <x-main-title>Sprawa pt. {{$ticket->title}} </x-main-title>
    <main>
        <p>{{$ticket->title}}</p>
        <p>{{$ticket->description}}</p>
        <p>{{$ticket->deadline}}</p>
        <p>{{$ticket->priority}}</p>

        <!-- Tymczasowo zrobione żeby można było wejść -->
        <p> <a href="redirect/{{$ticket->id}}">Prześlij sprawę</a></p>
    </main>
@endsection

