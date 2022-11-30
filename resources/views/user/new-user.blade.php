@extends('templates.layout-base')

@section('cont')
        <div class="login">
        <form method="POST" action="/create-password" class= "login__form">
            @csrf
            @method('PUT')
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
                <div class="login__input-box">
                    <input type="password" class="login__input" placeholder="Podaj nowe hasło" id="password" name="password" value="">
                    <input type="password" class="login__input" placeholder="Potwierdź nowe hasło" id="password_confirmation" name="password_confirmation" value="">
                </div>
            </div>
            <div class="login__center">
                <button type="submit" class="login__button login__button--reset-password">Zmień hasło</button>
            </div>

            <div class="login__error-panel">
                @error('password')
                <p class="login__errormessage">{{$message}}</p>
                @enderror

                @error('password_confirmation')
                <p class="login__errormessage">{{$message}}</p>
                @enderror
            </div>
            
            <input type="hidden" name="token" value="{{$token}}">
        </form>
    </div>

@endsection


