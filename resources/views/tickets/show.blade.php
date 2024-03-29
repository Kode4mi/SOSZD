@extends('templates.layout')

@section('content')
    <x-main-title>Sprawa pt. {{$ticket->title}} </x-main-title>
    <main class="main-window ticket">
        <div class="ticket__header">
            <div>
                <span class="ticket__header--deadline">Termin: {{$ticket->deadline}}</span>
            </div>
            <div>
                <span class="ticket__header--priority">Priorytet: {{$ticket->priority}}</span>
            </div>
        </div>
        <hr/>
        <p class="ticket__from">Od:

            {{$sender->first_name}}
            {{$sender->last_name}}

        </p>
        <hr/>
        <p class="ticket__header-content">Treść:</p>
        <div class="ticket__content">
            <textarea class="ticket__content-description" disabled>{{$ticket->description}}</textarea>
            <div class="ticket__content-footer">
                @unless($ticket->files === null)
                    <p class="">Załączniki:</p>

                    @foreach($ticket->getFiles() as $file)
                        <a href="{{asset("storage/".$file)}}" class="main-window__a">
                            <i class="fa-sharp fa-solid fa-paperclip"></i>
                        </a>
                    @endforeach
                @endunless


                    @if(!is_array($users))
                        <x-redirect-form :$ticket :$users></x-redirect-form>
                        <div class="ticket__buttons">
                    @elseif($ticket->sender_id === auth()->user()->id && is_array($users))
                    <div class="sentbox">
                        @foreach($users as $user)
                            <div class="sentbox__userdata">
                                <span class="sentbox__userdata-text">{{$user["first_name"]}} {{$user["last_name"]}}</span>

                            @php

                                $redirect = App\Models\Redirect::where('ticket_id', $ticket->id)->where('user_id', $user['id'])->first();
                                $reply = \App\Models\Reply::where('redirect_id', $redirect->id)->first();

                            @endphp

                            @if($redirect->hasReply())
                                <a href="{{url('reply/'.$reply->slug)}}" class="main-window__a">
                                    <x-tooltip-parent tooltip="Odpowiedź">
                                        <i class="fa-sharp fa-solid fa-envelope-circle-check cursor-pointer"></i>
                                    </x-tooltip-parent>
                                </a>
                            @else
                                @if($user['read'] === 1)
                                        <x-tooltip-parent tooltip="Otwarto">
                                            <i class="fa-sharp fa-solid fa-envelope-open cursor-pointer"></i>
                                        </x-tooltip-parent>
                                @else
                                        <x-tooltip-parent tooltip="Wysłano">
                                            <i class="fa-sharp fa-solid fa-paper-plane cursor-pointer" title="Wysłano"></i>
                                        </x-tooltip-parent>
                                @endif
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                        @unless($redirect === null)
                            @unless($redirect->hasReply())
                                <div class="ticket__buttons">
                                <a class="main-window__a" href=" {{url('reply/create/'.$redirect['slug'])}} ">
                                    <button class="ticket__anwser">
                                        Odpowiedz
                                    </button>
                                </a>
                            @else
                                        <div class="ticket__buttons">
                                    <button class="ticket__anwser ticket__anwser--disabled" disabled>
                                        Odpowiedź wysłano
                                    </button>
                            @endunless
                        @endunless
                    @endif

                @if(auth()->user()->id === $ticket->sender_id && $redirect !== null)
                   <div class="ticket__buttons">
                        <a class="main-window__a" href="/redirect/{{$ticket->slug}}">
                            <button class="ticket__submit">Prześlij sprawę</button>
                        </a>
                @endif

                @php
                    if($form === "archive") {
                            $tooltip="Dodaj do archiwum";
                            $title = "Zarchiwizuj";
                        }
                        else {
                            $tooltip="Przenieś do aktywnych spraw";
                            $title = "Od archiwizuj";
                        }
                @endphp
                <x-tooltip-parent tooltip="{{$tooltip}}">
                    <form method="POST" action="/{{$form}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id[]" value="{{$ticket->id}}">
                            <button type="submit" class="ticket__archive">
                                {{$title}}
                            </button>
                    </form>
                </x-tooltip-parent>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

