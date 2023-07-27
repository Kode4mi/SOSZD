@extends('templates.layout')

@section('content')
    <x-main-title>Zmień swoje dane </x-main-title>
    <main class="main-window edit_account user__main">

        <form action="/user" method="POST" class="user__form">

            @csrf
            @method("PUT")
            <h3 class="user__form-title">Zmień podstawowe dane swojego konta SOSZD:</h3>

            <label for="email" class="user__form-label">Zmień e-mail:</label>
            <input type="text" class="user__input" placeholder="E-mail" name="email" id="email" value="{{auth()->user()->email}}">

            @error('email')
            <p>{{$message}}</p>
            @enderror

            <label for="password" class="user__form-label">Wprowadź swoje hasło:</label>
            <input type="password" id="password" class="user__input" placeholder="Wprowadź swoje hasło, aby zmienić e-mail" name="password_confirmation">

            @error('password_confirmation')
            <p>{{$message}}</p>
            @enderror

            <button type="submit" class="user__submit">Zatwierdź e-mail</button>
            <hr />

            <p class="mt-2"><a class="main-window__a cursor-pointer" href="/change-password">Zmień hasło</a></p>

        </form>
    </main>
@endsection
