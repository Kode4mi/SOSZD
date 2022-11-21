@extends('templates.layout')

@section('content')
@if($users->count())
<x-main-title>Użytkownicy:</x-main-title>
    <main>

    <form action="/users" id="search_form" class="searchbar">
        <input class="form-control search searchbar__input" type="search" aria-label="Wyszukaj" name="search"
                @if(request('search' ?? null))
                value="{{request('search')}}"
                @endif
            />
            <button class="btn-outline-success btn-search searchbar__button" type="submit">   <i class="fa-solid fa-magnifying-glass"></i>    </button>
    </form>

<table class="users">
    <thead>
        <tr class="users__header-row">
            <th class="users__header-link">@sortablelink('last_name', 'Dane')</th>
            <!--ewentaulnie w oddzielnych polach jako:
                <th>@sortablelink('first_name', 'Imie')</th>
                <th>@sortablelink('last_name', 'Nazwisko')</th>-->
            <th class="users__header-link">@sortablelink('role', 'Stanowisko')</th>    
            <th class="users__header-link">@sortablelink('email', 'E-mail')</th>
            <th class="users__select-sorter">
                        <label for="select-sort" class="users__select-sorter-label">Sortuj po:</label>
                        <select name="select-sort" id="select-sort">
                            <option value="a">Dane (Rosnąco)</option>
                            <option value="s">Dane (Malejąco)</option>
                            <option value="d">Rola (Rosnąco)</option>
                            <option value="f">Rola (Malejąco)</option>
                            <option value="g">E-mail (Rosnąco)</option>
                            <option value="h">E-mail (Malejąco)</option>
                        </select>
                    </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $users)
        <tr class="users__row">
            <td class="users__name">{{$users->last_name}} {{$users->first_name}}</td>
            <td class="users__role">{{$users->role}}</td>
            <td class="users__email">{{$users->email}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<x-main-title>Brak użytkowników</x-main-title>
@endif

@endsection
