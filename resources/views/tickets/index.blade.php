@extends('templates.layout')

@section('content')
@if($tickets->count())
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

@endif
<a href="{{url('ticket/create')}}">Stwórz sprawę</a>

@endsection
