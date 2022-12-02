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

        <p class="">
            @foreach($users as $user)
            {{$user["first_name"]}} {{$user["last_name"]}}
                @if($user['read'] === 0)
                    <i class="fa-sharp fa-solid fa-paper-plane"></i>
                @else
                    <i class="fa-sharp fa-solid fa-envelope-open"></i>
                @endif
            @endforeach
        </p>

        @if(auth()->user()->id === $ticket->sender_id)
            <div> <a href="/redirect/{{$ticket->id}}"> <button class="ticket__submit">Prześlij sprawę </button></a> </div>
        @endif
    </main>
@endsection

