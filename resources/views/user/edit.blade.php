@extends('templates.layout')

@section('content')
    <x-main-title>Zmień swoje dane </x-main-title>
    <main class="main-window edit_account user__main">

        <h3>Zmień swój email</h3>

        <form action="/user" method="POST" class="user__form">

        @csrf
        @method("PUT")

            <input type="text" class="user__input" placeholder="E-mail" name="email" value="{{auth()->user()->email}}">

            @error('email')
            <p>{{$message}}</p>
            @enderror

            <input type="password" class="user__input" placeholder="Hasło" name="password">

            @error('password')
            <p>{{$message}}</p>
            @enderror

            <input type="password" class="user__input" placeholder="Potwierdź hasło" name="password_confirmation">

            @error('password_confirmation')
            <p>{{$message}}</p>
            @enderror

        <button type="submit" class="user__submit">Zatwierdź</button>

            <p class="mt-2"><a class="main-window__a" href="/change-password">Zmień hasło</a></p>

        </form>
    </main>
@endsection
