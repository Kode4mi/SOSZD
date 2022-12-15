@extends('templates.layout')

@section('content')
    <x-main-title>Zmień swoje dane </x-main-title>
    <main class="main-window edit_account">

        <h3>Zmień swój email</h3>

        <form action="/user" method="POST" class="user_edit">

        @csrf
        @method("PUT")

        <label>Email:
            <input type="text" class="user_edit__email" name="email" value="{{auth()->user()->email}}">
        </label><br>

            @error('email')
            <p>{{$message}}</p>
            @enderror

        <label>Hasło:
            <input type="password" class="user_edit__password" name="password">
        </label><br>

            @error('password')
            <p>{{$message}}</p>
            @enderror

        <label>Potwierdź hasło:
            <input type="password" class="user_edit__password-confirm" name="password_confirmation">
        </label><br>

            @error('password_confirmation')
            <p>{{$message}}</p>
            @enderror

        <button type="submit" class="user_edit__submit-button">Zatwierdź</button>

            <p class="mt-2"><a class="main-window__a" href="/change-password">Zmień hasło</a></p>

        </form>
    </main>
@endsection
