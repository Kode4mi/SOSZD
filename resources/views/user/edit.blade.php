@extends('templates.layout')

@section('content')
    <x-main-title>Zmień swoje dane </x-main-title>
    <main class="main-window edit_account user__main">

        <form action="/user" method="POST" class="user__form">

        @csrf
        @method("PUT")
            <h2>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h2>
            <br />

            <h4>Zmień e-mail:</h4>
            <input type="text" class="user__input" placeholder="E-mail" name="email" value="{{auth()->user()->email}}"> <br />
            <input type="password" class="user__input" placeholder="Wpisz hasło aby zmienić e-mail" name="password_confirmation">
            <button type="submit" class="user__submit">Zatwierdź e-mail</button>

         

            @error('email')
            <p>{{$message}}</p>
            @enderror
            
  

            <hr />
<!--
            <h4>Zmień hasło</h4>
            
            <input type="password" class="user__input" placeholder="Stare hasło" name="password">

            @error('password')
            <p>{{$message}}</p>
            @enderror <br/>

            <input type="password" class="user__input" placeholder="Nowe hasło" name="password_confirmation">

            @error('password_confirmation')
            <p>{{$message}}</p>
            @enderror

        <button type="submit" class="user__submit">Zatwierdź hasło</button>

        !-->
            <p class="mt-2"><a class="main-window__a" href="/change-password">Zmień hasło</a></p> 

        </form>
    </main>
@endsection
