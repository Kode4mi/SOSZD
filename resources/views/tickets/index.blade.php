@extends('templates.layout')

@section('content')
    @if($tickets->count())
        <x-main-title>{{$title}}:</x-main-title>
        <main>

            <form action="/tickets" id="search_form" class="searchbar">
                <input class="form-control  searchbar__input" type="search" aria-label="Wyszukaj"
                       name="search"
                       @if(request('search' ?? null))
                           value="{{request('search')}}"
                    @endif
                />
                <button class="btn-outline-success btn-search searchbar__button" type="submit"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <table>

                <thead>

                <tr>
                    <th class="ticket__select-all"><i class="fa-solid fa-pen-to-square " title="Zaznacz wszystko"></i>
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

                <tbody>

                @foreach($tickets as $ticket)
                    <tr class="ticket__row">
                        <td class="table">
                            <label class="table-checkbox">
                                <input type="checkbox" class="table-checkbox--input" name="id[]" value="{{$ticket->id}}"
                                       form="ticket__form-{{$form}}">
                                <span class="table-checkbox--checkmark"></span>
                            </label>
                        </td>
                        <td class="ticket__title">
                            <a href="ticket/{{$ticket->id}}" class="ticket-title">
                                {{$ticket->title}}
                                <input type="hidden" value="{{$ticket->id}}" class="id">
                            </a>
                        </td>
                        <td class="ticket__sender">

                            @php
                                /* @var User $users */
                                $user = $users::find($ticket->sender_id);
                            @endphp
                            {{$user->first_name}}
                            {{$user->last_name}}
                        </td>
                        <td class="ticket__deadline">{{$ticket->deadline}}</td>
                        <td class="ticket__priority">{{$ticket->priority}}</td>

                    </tr>
                @endforeach

                </tbody>

            </table>
            <div class="table-footer">
                {{$tickets->links()}}
                <div>
                    <button type="submit" class="table-footer--button" form="ticket__form-{{$form}}"
                            @if($form === "archive")
                                title="Dodaj do archiwum"
                            @else
                                title="Przenieś do aktywnych spraw"
                        @endif
                    >
                        <i class="fa-solid fa-folder-closed"></i>
                    </button>
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

    <script>

        if (!$('.table-footer--links')[0]) {
            $('.table-footer').css('justify-content', 'flex-end');
        }

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

        $('.ticket__select-all').click(function () {
            let checkbox = $('.table-checkbox--input');

            if (checkbox.prop('checked'))
                checkbox.prop('checked', false);
            else
                checkbox.prop('checked', true);
        });

        $('#select-sort').change(function () {
            console.log($(this).prop('selectedIndex'));

            $.cookie('sort', $(this).prop('selectedIndex'));

            window.location = $(this).val();
        });

        $(function () {
            $('#select-sort').prop('selectedIndex', $.cookie('sort'));
        });

    </script>

@endsection
