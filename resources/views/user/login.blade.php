@extends('templates.layout-base')

@section('cont')
    <div class="login">
        <form method="POST" action="users/authenticate" class= "login__form">
            @csrf
            @method("POST")
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
            <div class="login__inputbox">
                <input type="text" name="email" class="login__input" placeholder="Login">
                <input type="password" name="password" class="login__input" placeholder="Hasło">
            </div>
            <div class="login__center">
                <button type="submit" class="login__button">Zaloguj</button>
            </div>

            <div class="login__errorpanel">
                @error('password')
                <p class="login__errormessage">{{$message}}</p>
                @enderror

                @error('email')
                <p class="login__errormessage">{{$message}}</p>
                @enderror
            </div>
        </form>
    </div>
@endsection
