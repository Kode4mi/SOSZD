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
        <p class="ticket__from">Od:

            {{$sender->first_name}}
            {{$sender->last_name}}

        </p>
        <hr />
        <p class="ticket__header-content">Treść:</p>
        <p class="ticket__content">{{$ticket->description}}</p>

        <p class="">
            @if($ticket->sender_id === auth()->user()->id)
                @foreach($users as $user)
                {{$user["first_name"]}} {{$user["last_name"]}}
                    @if($user['read'] === 1)
                        <i class="fa-sharp fa-solid fa-envelope-open" title="Otwarto"></i>
{{--                    @elseif(odpowiedz === true)--}}
{{--                        <i class="fa-sharp fa-solid fa-envelope-dot"></i>--}}
                    @else
                        <i class="fa-sharp fa-solid fa-paper-plane" title="Wysłano"></i>
                    @endif
                @endforeach
            @else
                @unless($redirect === null)
                    @unless($redirect->hasReply())
                        <a href=" {{url('reply/'.$redirect['id'])}} "> <i class="fa-sharp fa-solid fa-reply" title="Odpowiedz"></i> </a>
                    @else
                        <span>Odpowiedź została już wysłana</span>
                    @endunless
                @endunless
            @endif
        </p>

        @if(auth()->user()->id === $ticket->sender_id)
            <div> <a href="/redirect/{{$ticket->id}}"> <button class="ticket__submit">Prześlij sprawę </button></a> </div>
        @endif
    </main>
@endsection

