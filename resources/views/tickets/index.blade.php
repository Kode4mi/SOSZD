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
        <th><i class="fa-solid fa-pen-to-square ticket-select-all"></i></th>
        <th>@sortablelink('title', 'Tytuł')</th>
        <th>@sortablelink('sender_id', 'Nadawca')</th>
        <th>@sortablelink('deadline', 'Termin')</th>
        <th>@sortablelink('priority', 'Priorytet')</th>
    </tr>

    </thead>

<tbody>

@foreach($tickets as $ticket)
<tr class="ticket-row">
    <td>
        <label class="table-checkbox">
            <input type="checkbox" class="table-checkbox--input" name="id[]" value="{{$ticket->id}}" form="ticket-form-archive">
            <span class="table-checkbox--checkmark"></span>
        </label>
    </td>
    <td>
        <a href="ticket/{{$ticket->id}}" class="ticket-title">
            {{$ticket->title}}
            <input type="hidden" value="{{$ticket->id}}" class="id">
        </a>
    </td>
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
<div class="table-footer">
    {{$tickets->links()}}
    <span>
        <button type="submit" class="table-footer--button" form="ticket-form-archive">
            <i class="fa-solid fa-folder-closed"></i>
        </button>
    </span>
</div>
    </main>
        @else
            <x-main-title>Brak spraw</x-main-title>
@endif

<form action='/archive' method='POST' id="ticket-form-archive">
    @csrf
    @method("PUT")
</form>

<form action='/unarchive' method='POST' id="ticket-form-unarchive">
    @csrf
    @method("PUT")
</form>


<script>

    if(!$('.table-footer--links')[0])    {
        $('.table-footer').css('justify-content', 'flex-end');
    }

    $(".ticket-row").draggable({
        helper: function () {
            return $('<div></div>').append($(this).find('.ticket-title').clone());
        }
    });

    $(".main__frame--archive_button").droppable({
        accept: '.ticket-row',
        drop: function(event, ui) {sendArchiveForm(event, ui, "archive") },
    });

    $(".navbar__sidebar--button1").droppable({
        accept: '.ticket-row',
        drop: function(event, ui) {sendArchiveForm(event, ui, "unarchive") },
    });


    function sendArchiveForm(event, ui, str) {
        let draggable = ui.draggable;
        const obj = draggable.clone();
        const id = obj.find('.id').val();

        const form = $("#ticket-form-"+str);

        form.append(" <input type='hidden' name='id' value=" + id + " />");

        form.submit();
    }

    $('.table-checkbox--input').change(function () {
        console.log($(this).val());
        if ($(this).is(':checked')) {
            console.log('checked');
        }
    });

    $('.ticket-select-all').click(function () {
        let checkbox = $('.table-checkbox--input');

        if(checkbox.prop('checked'))
            checkbox.prop('checked', false);
        else
            checkbox.prop('checked', true);
    });

</script>


@endsection
