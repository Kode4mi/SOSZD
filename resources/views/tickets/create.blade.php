@extends('templates.layout')

@section('content')
<x-main-title>Tworzenie sprawy: </x-main-title>

<main class="create-ticket">
    <form action="/ticket" method="POST" class="create-ticket__form">
        @csrf

        <label>Temat:
            <input type="text" name="title" class="create-ticket__topic" value="{{old('title')}}">
        </label>

        @error('title')
            <p>{{$message}}</p>
        @enderror

        <label>Termin:
            <input type="datetime-local" name="deadline" class="create-ticket__deadline" value="{{date('Y-m-d')}}T{{date('H:i')}}">
        </label>

        @error('deadline')
            <p>{{$message}}</p>
        @enderror

        <label>Priorytet:
            <select class="create-ticket__select" name="priority">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </label>

        @error('priority')
        <p>{{$message}}</p>
        @enderror

        <label class="create-ticket__label-opis">Opis:
            <textarea name="description" class="create-ticket__content"> {{old('description')}} </textarea>
        </label>

        @error('description')
        <p>{{$message}}</p>
        @enderror

        <button type="submit" class="create-ticket__button">Zatwierdź</button>
    </form>
</main>

@endsection
