@extends('templates.layout')

@section('content')
<x-main-title>Przekazywanie sprawy: <br> {{$ticket->title}} </x-main-title>

<main class="redirect-ticket">


<form action="/ticket" method="POST">

@csrf

    <label>Temat:
        <p>{{$ticket->title}}</p>
    </label><br>

    <label>Termin:
        <p>{{$ticket->deadline}}</p>
    </label><br>

    <label>Priorytet:
        <p>{{$ticket->priority}}</p>
    </label>
    <br>

<label class="label_adresat">Adresaci: <br/>
    <select name="reciever">
        @foreach($users as $user)
            @foreach($redirects as $redirect)
                @if($user->id !== $redirect->user_id)
                    <option value="{{$user->id}}"> {{$user->first_name}} {{$user->last_name}} </option>
                @endif
            @endforeach
        @endforeach
    </select>
</label><br>

    @error('reciever')
    <p>{{$message}}</p>
    @enderror

<button type="submit">Prześlij</button>

</form>
</main>

@endsection
