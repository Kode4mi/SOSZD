@extends('templates.layout-base')

@section('cont')

    <main>

        <form action="/reset-password" method="POST" class="w-full text-center mt-5">
            @csrf
            @method('POST')

            <h1>Zresetuj hasło</h1>
            <p>
                <label for="email" class="mt-4">Podaj swój email</label>
                <input type="text" id="email" name="email" value="">
            </p>

            @error('email')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <p>
                <label for="password" class="mt-4">Podaj nowe hasło</label>
                <input type="password" id="password" name="password" value="">
            </p>

            @error('password')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <p>
                <label for="password_confirmation" class="mt-4">Powtórz nowe hasło</label>
                <input type="password" id="password_confirmation" name="password_confirmation" value="">
            </p>

            @error('password_confirmation')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <input type="hidden" name="token" value="{{$token}}">

            <p>
                <button type="submit" class="mt-4">Zmień hasło</button>
            </p>
        </form>

        @endsection
        25
