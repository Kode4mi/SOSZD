@extends('templates.layout-base')

@section('cont')

    <main class="main-window login">

        <form method="POST" action="/forget-password" class="login__form login__form--forget-password">
            @csrf
            @method('POST')

            <div class="login__center">
                <div class="login__icon-box">
                    <div class="login__large-font login__icon"><i class="fa-solid fa-a"></i></div>
                    <div class="login__small-font login__icon"><i class="fa-solid fa-a"></i></div>
                    <div class="login__contrast login__icon"><i class="fa-solid fa-circle-half-stroke"
                                                                onClick="contrastToggle()"></i></div>
                </div>
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
        <script>
            document.querySelector('.login__large-font').addEventListener("click", function increaseFontSize() {
                const rootX  = document.querySelector(":root");
                let fontSizeOfRoot = window.getComputedStyle(rootX, null).getPropertyValue('font-size');
                fontSizeOfRoot = parseFloat(fontSizeOfRoot);
                if(fontSizeOfRoot < 16)
                rootX.style.fontSize = (fontSizeOfRoot + 1)+"px";
            });

            document.querySelector('.login__small-font').addEventListener("click", function decreaseFontSize() {
                const rootX  = document.querySelector(":root");
                let fontSizeOfRoot = window.getComputedStyle(rootX, null).getPropertyValue('font-size');
                fontSizeOfRoot = parseFloat(fontSizeOfRoot);
                if(fontSizeOfRoot > 8)
                rootX.style.fontSize = (fontSizeOfRoot - 1) +"px";
            });
        </script>
    </main>

@endsection
