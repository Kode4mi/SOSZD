@extends('templates.layout-base')

@section('cont')

    <main>

        <form method="POST" action="/forget-password" class="w-full text-center mt-5">
            @csrf
            @method('POST')
            <p>
                <label for="email">Podaj email twojego konta: </label>
                <input type="text" value="" id="email" name="email">
            </p>

            @error('email')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <p>
                <button type="submit">Wyślij email zmiany hasła</button>
            </p>
        </form>

    </main>

@endsection
