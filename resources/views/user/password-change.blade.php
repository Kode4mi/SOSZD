@extends('templates.layout')

@section('content')
    <x-main-title>Zmiana hasła: </x-main-title>

    <main class="main-window user__main">
        <form action="/change-password" method="POST" class="user__form">
            @csrf
            @method('POST')
            <div class="user__input-box">
                <input class="user__input" type="password" id="old_password" name="old_password" placeholder="Podaj stare hasło" value="">

                @error('old_password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
                    
                <input class="user__input" type="password" id="password" name="password" placeholder="Podaj nowe hasło" value="">

                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
                
                <input class="user__input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Powtórz nowe hasło" value="">

                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            
            <button type="submit" class="user__submit">Zmień hasło</button>
        </form>
    </main>
@endsection
