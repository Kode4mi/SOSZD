@extends('templates.layout')

@section('content')
    <p>{{$ticket->temat}}</p>
    <p>{{$ticket->opis}}</p>
    <p>{{$ticket->termin}}</p>
    <p>{{$ticket->priorytet}}</p>
@endsection
