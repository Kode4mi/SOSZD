@extends('templates.layout')

@section('content')
    <x-main-title>Dodaj nowego użytkownika: </x-main-title>
    <main>

        <form method="POST" action="/user">

            @csrf
            @method("POST")

            <label>
                Imie: <input type="text" name="first_name" value="{{old('first_name')}}" />
            </label> <br>

            @error('first_name')
            <p>{{$message}}</p>
            @enderror

            <label>
                Nazwisko: <input type="text" name="last_name" value="{{old('last_name')}}" />
            </label> <br>

            @error('last_name')
            <p>{{$message}}</p>
            @enderror

            <label>
                Email: <input type="text" name="email" value="{{old('email')}}" />
            </label> <br>

            @error('email')
            <p>{{$message}}</p>
            @enderror

            <label>
                Admin? <input type="checkbox" name="role" value="admin" />
            </label> <br>

            @error('role')
            <p>{{$message}}</p>
            @enderror

            <button type="submit">
                Stwórz nowego użytkownika
            </button>

        </form>

    </main>
@endsection
