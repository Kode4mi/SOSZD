<form class="redirect-form" action="/redirect/{{$ticket->slug}}" method="POST">

    @csrf
    @method("POST")

    <label class="label_adresat" for="user_select">Adresaci:</label>
    <select class="redirect-form__select" name="user_id[]" multiple id="user_select">
        @foreach($users as $user)
            <option class="redirect-form__option" value="{{$user->id}}"> {{$user->first_name}} {{$user->last_name}} </option>
        @endforeach
    </select>

    @error('user_id')
    <p>{{$message}}</p>
    @enderror

    <button class="redirect-form__button" type="submit">Prześlij</button>

</form>
