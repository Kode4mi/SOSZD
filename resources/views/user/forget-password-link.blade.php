@extends('templates.layout-base')

@section('cont')
<div class="login">
<form method="POST" action="users/authenticate" class= "login__form">
            @csrf
            @method("POST")
            <div class="login__center">
                <div class="login__icon-box">
                    <div class="login__large-font login__icon"><i class="fa-solid fa-a fa-3x"></i></div>
                    <div class="login__small-font login__icon"><i class="fa-solid fa-a fa-2xs"></i></div>
                    <div class="login__contrast login__icon" ><i class="fa-solid fa-circle-half-stroke fa-3x" onClick="contrastToggle()"></i></div>
                </div>
            </div>
            <div class="login__center">
                <div class="login__logo">
                    <img src="{{asset('images/logo.png')}}" alt="logo">
                </div>
            </div>
            <div class="login__center">
                <div class="login__input-box login__input-box--password-reset">
                    <input type="text" class="login__input" placeholder="Podaj swój adres mail"  id="email" name="email" value="">
                    <input type="password" class="login__input" placeholder="Podaj nowe hasło" id="password" name="password" value="">
                    <input type="password" class="login__input" placeholder="Potwierdź nowe hasło" id="password_confirmation" name="password_confirmation" value="">
                </div>
            </div>
            <div class="login__center">
                <button type="submit" class="login__button login__button--reset-password">Zresetuj hasło</button>
            </div>

            <div class="login__error-panel">
                @error('password')
                <p class="login__errormessage">{{$message}}</p>
                @enderror

                @error('password_confirmation')
                <p class="login__errormessage">{{$message}}</p>
                @enderror

                @error('email')
                <p class="login__errormessage">{{$message}}</p>
                @enderror
            </div>
        </form>
    </div>

@endsection

