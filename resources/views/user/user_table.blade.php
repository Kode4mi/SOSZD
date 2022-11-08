@extends('templates.layout')

@section('content')
@if($users->count())
<x-main-title>Użytkownicy:</x-main-title>
    <main>

    <form action="/user/user_table" id="search_form">    
        <input class="form-control search w-25" type="search" aria-label="Wyszukaj" name="search"
                @if(request('search' ?? null))
                value="{{request('search')}}"
                @endif
            />
            <button class="btn-outline-success btn-search" type="submit">   <i class="fa-solid fa-magnifying-glass"></i>    </button>
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
    @else
        <x-main-title>Brak użytkowników</x-main-title>
@endif

@endsection
