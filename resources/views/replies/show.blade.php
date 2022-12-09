@extends('templates.layout')

@section('content')
    <x-main-title>Odp do sprawy: {{$ticket->title}} </x-main-title>
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

            {{$user->first_name}}
            {{$user->last_name}}

        </p>
        <hr />
        <p class="ticket__header-content">Treść:</p>
        <p class="ticket__content">{{$reply->message}}</p>

        @unless($reply->files === null)
            <p class="">Załączniki:</p>

            @foreach($reply->getFiles() as $file)
                <a href="{{asset("storage/".$file)}}" style="color: black;">Plik
                    {{--                    <img src="{{asset("storage/".$file)}}" alt="Załącznik" width="100px"/>--}}
                </a>
            @endforeach
        @endunless


    </main>
@endsection

