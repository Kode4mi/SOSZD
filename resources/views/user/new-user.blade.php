@extends('templates.layout-base')

@section('cont')

    <main>

        <form action="/create-password" method="POST" class="w-full text-center mt-5">
            @csrf
            @method('PUT')

            <h1>Utwórz hasło do twojego konta w {{env('app.name')}}</h1>

            <p>
                <label for="password" class="mt-4">Podaj hasło</label>
                <input type="password" id="password" name="password" value="">
            </p>

            @error('password')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <p>
                <label for="password_confirmation" class="mt-4">Powtórz hasło</label>
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


