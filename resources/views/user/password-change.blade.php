@extends('templates.layout')

@section('content')
    <x-main-title>Zmień swoje dane:</x-main-title>

    <main class="main-window edit_account user__main">
        <form action="/change-password" method="POST" class="user__form">
            @csrf
            @method('POST')
            <h3 class="user__form-title">Zmień swoje hasło:</h3>
            <label for="old_password" class="user__form-label">Stare hasło:</label>
            <input class="user__input" type="password" id="old_password" name="old_password"
                   placeholder="Podaj stare hasło" value="">

            @error('old_password')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <label for="password" class="user__form-label">Nowe hasło:</label>
            <input class="user__input" type="password" id="password" name="password" placeholder="Podaj nowe hasło"
                   value="">

            @error('password')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <label for="password_confirmation" class="user__form-label">Potwierdź nowe hasło:</label>
            <input class="user__input" type="password" id="password_confirmation" name="password_confirmation"
                   placeholder="Powtórz nowe hasło" value="">

            @error('password_confirmation')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <button type="submit" class="user__submit">Zmień hasło</button>

            <p class="mt-2"><a class="main-window__a cursor-pointer" href="/user/edit">Zmień e-mail</a></p>
        </form>
    </main>
@endsection
