@extends('templates.layout')

@section('content')
    <x-main-title>Zmień swoje dane: </x-main-title>

    <main class="main-window user__main">
        <form action="/change-password" method="POST" class="user__form">
            @csrf
            @method('POST')
            <h2>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h2>
            <br />
            <div class="user__input-box">
                <h4>Zmień hasło:</h4>
                <input class="user__input" type="password" id="old_password" name="old_password" placeholder="Podaj stare hasło" value=""> <br />

                @error('old_password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
                    
                <input class="user__input" type="password" id="password" name="password" placeholder="Podaj nowe hasło" value=""> <br />

                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
                
                <input class="user__input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Powtórz nowe hasło" value=""> <br />

                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            
            <button type="submit" class="user__submit">Zmień hasło</button> <br />

            <p class="mt-2"><a class="main-window__a" href="/user/edit">Zmień e-mail</a></p> 
        </form>
    </main>
@endsection
