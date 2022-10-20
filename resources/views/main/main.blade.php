@extends('templates.layout')

<table>

    <thead>

    <tr>
        <th>Temat</th>
        <th>Opis</th>
        <th>Termin</th>
        <th>Priorytet</th>
    </tr>

    </thead>
<tbody>

@foreach($tickets as $ticket)
<tr>

    <td>{{$ticket->temat}}</td>
    <td>{{$ticket->opis}}</td>
    <td>{{$ticket->termin}}</td>
    <td>{{$ticket->priorytet}}</td>


</tr>
@endforeach

</tbody>



</table>
