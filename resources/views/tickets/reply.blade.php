@extends('templates.layout')

@section('content')
    <x-main-title>Odpowiedz na sprawę</x-main-title>

    <main class="redirect-ticket">

        <p>Temat:</p>
        <p>{{$ticket->title}}</p>

        <p>Priorytet: </p>
        <p>{{$ticket->priority}}</p>

        <p>Termin:</p>
        <p>{{$ticket->deadline}}</p>

        <p>Opis:</p>
        <p>{{$ticket->description}}</p>

        <form action="/reply/{{$redirect->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <label for="message">Treść wiadomości: </label> <br>
            <textarea name="message" id="message"></textarea>
            <br>
            <label for="files">Dodaj pliki</label><br>
            <input type="file" name="files[]" id="files" multiple/>
            <br>
            <button type="submit">Prześlij</button>

        </form>
    </main>

@endsection
