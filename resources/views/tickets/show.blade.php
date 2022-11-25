@extends('templates.layout')

@section('content')
    <x-main-title>Sprawa pt. {{$ticket->title}} </x-main-title>
    <main class="ticket">
        <div class="ticket__header"> 
            <div>
                <span class="ticket__header--deadline">Termin: {{$ticket->deadline}}</span> 
            </div>
            <div>
                <span class="ticket__header--priority">Priorytet: {{$ticket->priority}}</span> 
            </div>
        </div>
        <hr />
        <p class="ticket__from">Od: </p>
        <hr />
        <p class="ticket__header-content">Treść:</p>
        <p class="ticket__content">{{$ticket->description}}</p>
        
        <div> <a href="/redirect/{{$ticket->id}}"> <button class="ticket__submit">Prześlij sprawę </button></a> </div>
    </main>
@endsection

