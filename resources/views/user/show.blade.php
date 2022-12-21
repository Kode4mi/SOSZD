@extends('templates.layout')

@section('content')
    <x-main-title>Zmień dane użytkownika {{$user->first_name}} {{$user->last_name}}</x-main-title>
    <main class="edit_account">
        <form action="/update_user" method="POST" class="user_edit">

        @csrf
        @method("PUT")

        <label>Email:
            <input type="text" class="user_edit__email" name="email" value="{{$user->email}}">
        </label><br>

            @error('email')
            <p>{{$message}}</p>
            @enderror
        
        <label>Imie:
            <input type="text" class="user_edit__email" name="first_name" value="{{$user->first_name}}">
        </label><br>
            @error('first_name')
            <p>{{$message}}</p>
            @enderror

        <label>Nazwisko:
            <input type="text" class="user_edit__email" name="last_name" value="{{$user->last_name}}">
        </label><br>
            @error('last_name')
            <p>{{$message}}</p>
            @enderror

        <label>Stanowisko:
            <select name="role">
                <option value="nauczyciel">Nauczyciel</option>
                <option value="admin">Admin</option>
                 <!-- Dorobić żeby zaznaczone było stanowisko danego użytkownika -->
            </select>
        </label><br>

            @error('role')
            <p>{{$message}}</p>
            @enderror



        <label>Reset hasła?:
            <button class="user_edit__password" name="password_reset">Resetuj hasło</button>
        </label><br>

            @error('password_reset')
            <p>{{$message}}</p>
            @enderror


            <input type="hidden" name="user_info" value="{{$user->id}}">
        <button type="submit" class="user_edit__submit-button">Zatwierdź</button>

        </form>
    </main>
@endsection
