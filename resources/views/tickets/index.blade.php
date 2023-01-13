@extends('templates.layout')

@section('content')
    @if($tickets->count())
        <x-main-title>{{$title}}:</x-main-title>
        <main class="main-window">

            <form action="/tickets" id="search_form" class="searchbar">
                <input class="form-control  searchbar__input" type="search" aria-label="Wyszukaj"
                        placeholder="Wyszukaj..."
                        name="search"
                       @if(request('search' ?? null))
                           value="{{request('search')}}"
                    @endif
                />
                <button class="btn-outline-success btn-search searchbar__button" type="submit"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <table class="main-window__table">

                <thead class="main-window__thead">

                <tr class="main-window__tr ticket__header-row">
                    <th class="ticket__select-all"><x-tooltip-parent tooltip="Zaznacz wszystko"><i class="fa-solid fa-pen-to-square "></i></x-tooltip-parent>
                    </th>
                    <th class="ticket__sorter">@sortablelink('title', 'Tytuł')</th>
                    <th class="ticket__sorter">@sortablelink('sender_id', 'Nadawca')</th>
                    <th class="ticket__sorter">@sortablelink('deadline', 'Termin')</th>
                    <th class="ticket__sorter">@sortablelink('priority', 'Priorytet')</th>
                    <th class="ticket__select-sorter">
                        <label for="select-sort" class="ticket__select-sorter-label">Sortuj po:</label>
                        <select name="select-sort" id="select-sort">
                            <option value="tickets?sort=title&direction=asc">Tytuł (Rosnąco)</option>
                            <option value="tickets?sort=title&direction=desc">Tytuł (Malejąco)</option>
                            <option value="tickets?sort=sender_id&direction=asc">Nadawca (Rosnąco)</option>
                            <option value="tickets?sort=sender_id&direction=desc">Nadawca (Malejąco)</option>
                            <option value="tickets?sort=deadline&direction=asc">Termin (Rosnąco)</option>
                            <option value="tickets?sort=deadline&direction=desc">Termin (Malejąco)</option>
                            <option value="tickets?sort=priority&direction=asc">Priorytet (Rosnąco)</option>
                            <option value="tickets?sort=priority&direction=desc">Priorytet (Malejąco)</option>
                        </select>
                    </th>
                </tr>

                </thead>

                <tbody class="main-window__tbody">

                @foreach($tickets as $ticket)
                    <tr class="main-window__tr ticket__row">
                        <td class="main-window__td table">
                            <label class="table-checkbox">
                                <input type="checkbox" class="table-checkbox--input" name="id[]" value="{{$ticket->id}}"
                                       form="ticket__form-{{$form}}">
                                <span class="table-checkbox--checkmark"></span>
                            </label>
                        </td>
                        <td class="main-window__td ticket__title">
                            @if(auth()->user()->id !== $ticket->sender_id && auth()->user()->role !== "admin")

                                @php

                                    $redirect = \App\Models\Redirect::where('ticket_id', $ticket->id)->where('user_id', auth()->user()->id)->first('read');


                                @endphp

                            @endif
                            @if(isset($redirect) && !$redirect->read)
                                <b>
                                    @endif
                                    <a href="ticket/{{$ticket->slug}}" class="main-window__a ticket-title">
                                        {{$ticket->title}}
                                        <input type="hidden" value="{{$ticket->id}}" class="id">
                                    </a>
                                    @if(isset($redirect) && !$redirect->read)
                                </b>
                            @endif
                        </td>
                        <td class="main-window__td ticket__sender">

                            @php
                                /* @var \App\Models\User $users */
                                $user = $users::find($ticket->sender_id);
                            @endphp
                            {{$user->first_name}}
                            {{$user->last_name}}
                        </td>
                        <td class="main-window__td ticket__deadline
                        @if($ticket->deadline < date("Y-m-d H:i"))
                            color-red
                        @endif
                        "
                        >
                            {{$ticket->dateFormat()}}
                        </td>
                        <td class="main-window__td ticket__priority">{{$ticket->priority}}</td>

                    </tr>
                @endforeach

                </tbody>

            </table>
            <div class="table-footer">
                {{$tickets->links()}}
                <div>
                    @php
                        if($form === "archive")
                            $tooltip="Dodaj do archiwum";
                        else
                            $tooltip="Przenieś do aktywnych spraw";
                    @endphp
                    <x-tooltip-parent tooltip="{{$tooltip}}">
                        <button type="submit" class="table-footer--button" form="ticket__form-{{$form}}">
                                <i class="archive-button fa-solid fa-folder-closed"></i>
                        </button>
                    </x-tooltip-parent>
                </div>
            </div>
        </main>
    @else
        <x-main-title>Brak spraw</x-main-title>
    @endif

    <form action='/{{$form}}' method='POST' id="ticket__form-{{$form}}">
        @csrf
        @method("PUT")
    </form>

    <script type="text/javascript">

        if (!isMobile) {
            $(".ticket__row").draggable({
                helper: function () {
                    return $('<div></div>').append($(this).find('.ticket-title').clone());
                }
            });

            $(".navbar__sidebar--button_archive").droppable({
                accept: '.ticket__row',
                drop: function (event, ui) {
                    sendArchiveForm(event, ui, "archive")
                },
            });

            $(".navbar__sidebar--button1").droppable({
                accept: '.ticket__row',
                drop: function (event, ui) {
                    sendArchiveForm(event, ui, "unarchive")
                },
            });

            function sendArchiveForm(event, ui, str) {
                let draggable = ui.draggable;
                const obj = draggable.clone();
                const id = obj.find('.id').val();

                const form = $("#ticket__form-" + str);

                form.append(" <input type='hidden' name='id[]' value=" + id + " />");

                form.submit();
            }

        }


        if (!document.querySelectorAll('.table-footer--links')[0]) {
            document.querySelector('.table-footer').style.justifyContent = 'flex-end';
        }

        let flagChecked = false;
        document.querySelector('.ticket__select-all').addEventListener("click", function () {
            let checkboxes = document.querySelectorAll('.table-checkbox--input');

            checkboxes.forEach(checkbox => {
                checkbox.checked = !flagChecked;
            });

            flagChecked = !flagChecked;
        });

        const selectSort = document.getElementById("select-sort");

        selectSort.addEventListener("change", () => {

            document.cookie = "sort=" + selectSort.selectedIndex;

            window.location = selectSort.value;
        });

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        selectSort.selectedIndex = getCookie("sort");

    </script>

@endsection
