@extends('templates.layout-base')

@section('cont')

    <main class="main-window login">

        <form method="POST" action="/forget-password" class="login__form login__form--forget-password">
            @csrf
            @method('POST')
            <div class="login__center">
                <x-icon-box-logged-out />
            </div>
            <div class="login__center">
                <a href="{{url('/login')}}">
                    <div class="login__logo">
                        <img src="{{asset('images/logo.png')}}" alt="logo">
                    </div>
                </a>
            </div>

            <p>
                <label><input class="login__input" placeholder="Podaj email twojego konta:" type="text" value=""
                              id="email" name="email"></label>
            </p>

            <p>
                <button type="submit" class="login__button login__button--forget-password">Wyślij email zmiany hasła
                </button>
            </p>

            <div class="login__error-panel">
                @error('email')
                <p class="login__errormessage">{{$message}}</p>
                @enderror
            </div>
        </form>
    </main>

@endsection
