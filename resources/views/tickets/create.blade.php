@extends('templates.layout')

<h1>Tworzenie sprawy</h1>

<label>Temat:
    <input type="text" name="temat" value="{{old('temat')}}">
</label><br>

<label>Opis:
    <textarea name="opis" value="{{old('opis')}}"> </textarea>
</label><br>

<label>Termin:
    <input type="text" name="temat" value="{{old('termin') ?? date('H:i:s d-m-Y')}}">
</label><br>

<label>Priorytet:
    <select name="priorytet">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
</label>
<br>
<button type="submit">Zatwierdź</button>
