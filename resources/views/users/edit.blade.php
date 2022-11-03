@extends('templates.layout')

@section('content')
<h1>Użytkownicy</h1>

<form action="/users" method="POST">

@csrf

<label>Imie:
    <input type="text" name="first_name" value="{{old('first_name')}}">
</label><br>

    @error('first_name')
    <p>{{$message}}</p>
    @enderror

<label>Nazwisko:
    <input type="text" name="Last_name" value="{{old('Last_name')}}">
</label><br>

    @error('Last_name')
    <p>{{$message}}</p>
    @enderror

<label>Hasło:
    <input type="password" name="password" value="{{old('password')}}">
</label><br>

    @error('password')
    <p>{{$message}}</p>
    @enderror

<label>Potwierdź hasło:
    <input type="password" name="confirm-password" value="{{old('confirm-password')}}">
</label><br>

    @error('confirm-password')
    <p>{{$message}}</p>
    @enderror

<button type="submit">Zatwierdź</button>

</form>

@endsection
