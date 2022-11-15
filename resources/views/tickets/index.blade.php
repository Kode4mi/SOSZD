@extends('templates.layout')

@section('content')
@if($tickets->count())
<x-main-title>Aktualne sprawy: </x-main-title>
    <main>

    <form action="/tickets" id="search_form" class="searchbar">
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
        <th>@sortablelink('title', 'Tytuł')</th>
        <th>@sortablelink('sender_id', 'Nadawca')</th>
        <th>@sortablelink('deadline', 'Termin')</th>
        <th>@sortablelink('priority', 'Priorytet')</th>
    </tr>

    </thead>

<tbody>

@foreach($tickets as $ticket)
<tr class="ticket-row">

    <td><a href="ticket/{{$ticket->id}}" class="ticket-title">
            {{$ticket->title}}
            <input type="hidden" value="{{$ticket->id}}" class="id">
        </a></td>
    <td>

        @php
            /* @var User $users */
            $user = $users::find($ticket->sender_id);
        @endphp
        {{$user->first_name}}
        {{$user->last_name}}
    </td>
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

<form action='/archive' method='POST' id="ticket-form">
    @csrf
    @method("PUT")
</form>


<script>

    $(".ticket-row").draggable({
        helper: function () {
            return $('<div></div>').append($(this).find('.ticket-title').clone());
        }
    });

    $(".navbar__sidebar--button").droppable({
        accept: '.ticket-row',
        drop: function(event, ui) {sendArchiveForm(event, ui) },
    });

    function sendArchiveForm(event, ui) {
        let draggable = ui.draggable;
        const obj = draggable.clone();
        const id = obj.find('.id').val();

        const form = $("#ticket-form");

        form.append(" <input type='hidden' name='id' value=" + id + " />");

        form.submit();
    }

</script>


@endsection
