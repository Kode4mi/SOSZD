@extends('templates.layout')

@section('content')
<x-main-title>Tworzenie sprawy: </x-main-title>

<main class="main-window create-ticket">
    <form action="/ticket" method="POST" class="create-ticket__form" enctype="multipart/form-data">
        @csrf

            <input type="text" name="title" class="create-ticket__topic" placeholder="Temat" value="{{old('title')}}" spellcheck="true">

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

        <label class="create-ticket__label-opis">
            <textarea spellcheck="true" name="description" class="create-ticket__content" placeholder="Opis...">{{old('description')}}</textarea>
        </label>

        @error('description')
        <p>{{$message}}</p>
        @enderror

        <div class="create-ticket__bottom-container">
            <button type="submit" class="create-ticket__button">Zatwierdź</button>

            <label class="create-ticket__input-file create-ticket__label-file">
                <i class="fa-solid fa-paperclip"></i>
                <input type="file" name="files[]" class="create-ticket__input-file" multiple value="{{old('files')}}" />
            </label>

            @error('files')
            <p>{{$message}}</p>
            @enderror
        </div>
    </form>
</main>

@endsection
