@extends('templates.layout')

<h1>Tworzenie sprawy</h1>

<form action="/ticket" method="POST">

@csrf

<label>Temat:
    <input type="text" name="temat" value="{{old('temat')}}">
</label><br>

    @error('temat')
    <p>{{$message}}</p>
    @enderror

<label>Opis:
    <textarea name="opis" value="{{old('opis')}}"> </textarea>
</label><br>

    @error('opis')
    <p>{{$message}}</p>
    @enderror

<label>Termin:
    <input type="datetime-local" name="termin" value="{{date('Y-m-d')}}T{{date('H:i')}}">
</label><br>

    @error('termin')
    <p>{{$message}}</p>
    @enderror

<label>Priorytet:
    <select name="priorytet">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
</label>
<br>
    @error('priorytet')
    <p>{{$message}}</p>
    @enderror

<button type="submit">Zatwierdź</button>

</form>
