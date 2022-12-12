@extends('templates.layout')

@section('content')
    <x-main-title>Odpowiedz na sprawę pt. {{$ticket->title}}</x-main-title>

    <main class="reply">
        <div class="reply__header">
            <span class="reply__deadline">Termin: {{$ticket->deadline}}</span>
            <span class="reply__priority">Priorytet: {{$ticket->priority}}</span>
        </div>
        <hr>
        <div class="reply__content">    
            <div class="reply__original-message">
                <p>Opis:</p>
                <span class="reply__original-message-text">{{$ticket->description}}</span>
                <hr>
            </div>
            <form class="reply__form" action="/reply/{{$redirect->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="reply__form-message">
                    <label for="message">Treść wiadomości: </label>
                    <textarea class="reply__form-message-input" name="message" id="message"></textarea>
                </div>

                <div class="reply__bottom-container">
                    <button class="reply__button" type="submit">Prześlij</button>
                    <label class="reply__input-file reply__label-file">
                        <i class="fa-solid fa-paperclip"></i>
                        <input class="reply__input-file" type="file" name="files[]" id="files" multiple />
                    </label>
                </div>
            </form>
        </div>
    </main>

@endsection
