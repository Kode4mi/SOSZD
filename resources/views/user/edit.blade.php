@extends('templates.layout')

@section('content')
    <x-main-title>Edycja użytkownika: </x-main-title>
    <main>
        <form action="/user" method="POST">

        @csrf

        <label>Imie:
            <input type="text" name="first_name" value="{{auth()->user()->first_name}}">
        </label><br>

            @error('first_name')
            <p>{{$message}}</p>
            @enderror

        <label>Nazwisko:
            <input type="text" name="last_name" value="{{auth()->user()->last_name}}">
        </label><br>

            @error('last_name')
            <p>{{$message}}</p>
            @enderror

        <label>Hasło:
            <input type="password" name="password">
        </label><br>

            @error('password')
            <p>{{$message}}</p>
            @enderror

        <label>Potwierdź hasło:
            <input type="password" name="password_confirmation">
        </label><br>

            @error('password_confirmation')
            <p>{{$message}}</p>
            @enderror

        <button type="submit">Zatwierdź</button>

            <p class="mt-2"><a href="/change-password">Zmień hasło</a></p>

        </form>
    </main>
@endsection
