@extends('templates.layout-base')

@section('cont')
<div class="login">
<form method="POST" action="/reset-password/{{$token}}" action="users/authenticate class= "login__form">
            @csrf
            @method("POST")
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

