@extends('templates.layout-base')

@section('cont')

    <main class="login">

        <form method="POST" action="/forget-password" class="login__form login__form--forgetpassword">
            @csrf
            @method('POST')

            <div class="login__center">
                <div class="login__iconbox">
                    <div class="login__largefont login__icon"><i class="fa-solid fa-a fa-3x"></i></div>
                    <div class="login__smallfont login__icon"><i class="fa-solid fa-a fa-2xs"></i></div>
                    <div class="login__contrast login__icon" ><i class="fa-solid fa-circle-half-stroke fa-3x" onClick="contrastToggle()"></i></div>
                </div>
            </div>
            <div class="login__center">
                <div class="login__logo">
                    <img src="{{asset('images/logo-lepsze.png')}}" alt="logo">
                </div>
            </div>

            <p>
                <input class="login__input" placeholder="Podaj email twojego konta:" type="text" value="" id="email" name="email">
            </p>
           
            <p>
                <button type="submit" class="login__button login__button--forgetpassword">Wyślij email zmiany hasła</button>
            </p>
            
            <div class="login__errorpanel">
                @error('email')
                <p class="login__errormessage">{{$message}}</p>
                @enderror
            </div>
        </form>

    </main>

@endsection
