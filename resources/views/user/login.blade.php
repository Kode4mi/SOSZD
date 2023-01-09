@extends('templates.layout-base')

@section('cont')
    <div class="login">
        <form method="POST" action="users/authenticate" class= "login__form">
            @csrf
            @method("POST")
            <div class="login__center">
                <div class="login__icon-box">
                    <div class="login__large-font login__icon"><i class="fa-solid fa-a"></i></div>
                    <div class="login__small-font login__icon"><i class="fa-solid fa-a"></i></div>
                    <div class="login__contrast login__icon" ><i class="fa-solid fa-circle-half-stroke" onClick="contrastToggle()"></i></div>
                </div>
            </div>
            <div class="login__center">
                <div class="login__logo">
                    <img src="{{asset('images/logo.png')}}" alt="logo">
                </div>
            </div>
            <div class="login__center">
                <div class="login__input-box">
                    <label><input type="text" name="email" class="login__input" placeholder="Login"></label>
                    <label><input type="password" name="password" class="login__input" placeholder="Hasło"></label>
                </div>
                <a class="login__remind-password" href="/forget-password">Nie pamiętasz hasła?</a>
            </div>
            <div class="login__center">
                <button type="submit" class="login__button">Zaloguj</button>
            </div>

            <div class="login__error-panel">
                @error('password')
                <p class="login__errormessage">{{$message}}</p>
                @enderror

                @error('email')
                <p class="login__errormessage">{{$message}}</p>
                @enderror
            </div>
        </form>
    </div>

    <script type="text/javascript">
        document.querySelector('.login__contrast').addEventListener("click", function contrastToggle() {
        document.querySelector(".login").classList.toggle("contrast");
        document.querySelector(".flash-message-content").classList.toggle("contrast");
        });

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

@endsection

