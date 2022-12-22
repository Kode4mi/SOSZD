@extends('templates.layout')

@section('content')
    <x-main-title>Dodaj nowego użytkownika: </x-main-title>
    <main class="main-window user__main">
        <form class="user__form" method="POST" action="/user">
            @csrf
            @method("POST")
                
            <div class="user__input-box" />
                <input type="text" name="first_name" class="user__input first_name" placeholder="Imie" value="{{old('first_name')}}" />

                @error('first_name')
                <p>{{$message}}</p>
                @enderror

                <input type="text" name="last_name" class="user__input last_name" placeholder="Nazwisko" value="{{old('last_name')}}" />

                @error('last_name')
                <p>{{$message}}</p>
                @enderror

                <input type="text" name="email" class="user__input email" placeholder="E-mail" value="{{old('email')}}" />

                @error('email')
                <p>{{$message}}</p>
                @enderror
            </div>

            <label>
                <input type="checkbox" name="role" class="user__checkbox" value="admin" />
                Admin 
            </label>

            @error('role')
            <p>{{$message}}</p>
            @enderror

            <button type="submit" class="user__submit">
                Stwórz nowego użytkownika
            </button>

        </form>

    </main>
@endsection
