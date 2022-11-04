@extends('templates.layout')

@section('content')
@if($tickets->count())
<x-main-title>Aktualne sprawy: </x-main-title>
    <main>

    <form action="/tickets" id="search_form">
        <input class="form-control search w-25" type="search" aria-label="Wyszukaj" name="search"
               @if(request('search' ?? null))
               value="{{request('search')}}"
            @endif
        />
        <button class="btn-outline-success btn-search" type="submit">Wyszukaj</button>
    </form>

<table>

    <thead>

    <tr>
        <th>@sortablelink('temat')</th>
        <th>@sortablelink('opis')</th>
        <th>@sortablelink('termin')</th>
        <th>@sortablelink('priorytet')</th>
    </tr>

    </thead>

<tbody>

@foreach($tickets as $ticket)
<tr>

    <td><a href="ticket/{{$ticket->id}}">{{$ticket->title}}</a></td>
    <td>{{$ticket->description}}</td>
    <td>{{$ticket->deadline}}</td>
    <td>{{$ticket->priority}}</td>


</tr>
@endforeach

</tbody>

</table>

<p> {{$tickets->links()}} </p>
    </main>
        @else
            <x-main-title>Brak spraw</x-main-title>
@endif

@endsection
