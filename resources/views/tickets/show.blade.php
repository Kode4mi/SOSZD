@extends('templates.layout')

@section('content')
    <x-main-title>Sprawa nr {{$ticket->id}}: </x-main-title>
    <main>
        <p>{{$ticket->temat}}</p>
        <p>{{$ticket->opis}}</p>
        <p>{{$ticket->termin}}</p>
        <p>{{$ticket->priorytet}}</p>
    </main>
@endsection

