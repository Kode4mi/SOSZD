@extends('templates.layout-base')

@section('cont')
    <x-main-title>Login: </x-main-title>
    <main>
        <form method="POST" action="users/authenticate">
            @csrf
            @method("POST")
            <p><input type="text" name="email"></p>
            <p><input type="password" name="password"></p>
            <p><button type="submit">Zaloguj</button></p>
        </form>
    </main>
@endsection
