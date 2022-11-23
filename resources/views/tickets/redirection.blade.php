@extends('templates.layout')

@section('content')
    <x-main-title>Przekazywanie sprawy</x-main-title>

    <main class="redirect-ticket">

        <form action="/redirect/{{$ticket->id}}" method="POST">

            @csrf
            @method("POST")
            <p>Temat:</p>
            <p>{{$ticket->title}}</p>

            <p>Termin:</p>
            <p>{{$ticket->deadline}}</p>

            <p>Priorytet: </p>
            <p>{{$ticket->priority}}</p>

            <label class="label_adresat" for="user_select">Adresaci:</label>
            <p>
                <select name="user_id[]" multiple id="user_select">
                    @foreach($users as $user)
                        <option value="{{$user->id}}"> {{$user->first_name}} {{$user->last_name}} </option>
                    @endforeach
                </select>
            </p>

            @error('user_id')
            <p>{{$message}}</p>
            @enderror

            <button type="submit">Prześlij</button>

        </form>
    </main>

@endsection
