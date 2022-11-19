@extends('templates.layout')

@section('content')
@if($users->count())
<x-main-title>Użytkownicy:</x-main-title>
    <main>

    <form action="/users" id="search_form" class="searchbar">
        <input class="form-control search w-25 searchbar__input" type="search" aria-label="Wyszukaj" name="search"
                @if(request('search' ?? null))
                value="{{request('search')}}"
                @endif
            />
            <button class="btn-outline-success btn-search searchbar__button" type="submit">   <i class="fa-solid fa-magnifying-glass"></i>    </button>
    </form>

<table>

    <thead>

    <tr>
        <th>@sortablelink('last_name', 'Dane')</th>
        <!--
            ewentaulnie w oddzielnych polach jako:


            <th>@sortablelink('first_name', 'Imie')</th>
            <th>@sortablelink('last_name', 'Nazwisko')</th>
         -->
        <th>@sortablelink('role', 'Stanowisko')</th>
        <th>@sortablelink('email', 'E-mail')</th>
    </tr>

    </thead>
<tbody>
@foreach($users as $users)
<tr>

    <td>{{$users->last_name}} {{$users->first_name}}</td>
    <td>{{$users->role}}</td>
    <td>{{$users->email}}</td>

</tr>
@endforeach

</tbody>
</table>
        <a href="{{url('/user/register')}}">Stwórz nowego użytkownika</a>

    @else
        <x-main-title>Brak użytkowników</x-main-title>
@endif

@endsection
