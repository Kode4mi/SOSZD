@extends('templates.layout')

@section('content')
    <x-main-title>Zmiana hasła: </x-main-title>

    <main>
        <form action="/change-password" method="POST" class="w-full text-center mt-4">
            @csrf
            @method('POST')

            <p>
                <label for="old_password" class="mt-4">Podaj stare hasło</label>
                <input type="password" id="old_password" name="old_password" value="">
            </p>

            @error('old_password')
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

            <p>
                <button type="submit" class="mt-4">Zmień hasło</button>
            </p>
        </form>
    </main>
@endsection
