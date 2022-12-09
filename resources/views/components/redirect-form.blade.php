<form action="/redirect/{{$ticket->id}}" method="POST">

    @csrf
    @method("POST")

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
