@extends('templates.layout')

@section('content')
    <x-main-title>Zmień swoje dane </x-main-title>
    <main>

        <h3>Zmień swój email</h3>

        <form action="/user" method="POST">

        @csrf

        <label>Email:
            <input type="text" name="email" value="{{auth()->user()->email}}">
        </label><br>

            @error('email')
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
