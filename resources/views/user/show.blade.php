@extends('templates.layout')

@section('content')
    <x-main-title>Zmień dane użytkownika {{$user->first_name}} {{$user->last_name}}</x-main-title>
    <main class="edit_account">
        <form action="/user-update" method="POST" class="user_edit">

            @csrf
            @method("PUT")

            <label>Email:
                <input type="text" class="user_edit__email" name="email" value="{{$user->email}}">
            </label><br>

            @error('email')
            <p>{{$message}}</p>
            @enderror

            <label>Imie:
                <input type="text" class="user_edit__email" name="first_name" value="{{$user->first_name}}">
            </label><br>
            @error('first_name')
            <p>{{$message}}</p>
            @enderror

            <label>Nazwisko:
                <input type="text" class="user_edit__email" name="last_name" value="{{$user->last_name}}">
            </label><br>
            @error('last_name')
            <p>{{$message}}</p>
            @enderror

            <label>Stanowisko:
                <select name="role">
                    <option value="nauczyciel">Nauczyciel</option>
                    <option value="admin"
                            @if($user->role === "admin")
                                selected
                            @endif
                    >Admin
                    </option>
                </select>
            </label><br>

            @error('role')
            <p>{{$message}}</p>
            @enderror


            <label>Reset hasła?:
                <button type="button"
                        class="user_edit__password"
                        onclick="passwordResetForm()"
                >Wyślij email z resetem hasła</button>
            </label><br>

            @error('password_reset')
            <p>{{$message}}</p>
            @enderror

            <button type="submit" class="user_edit__submit-button">Zatwierdź</button>

        </form>

        <form action="/reset-password-and-send-email"
              method="POST"
              id="password-reset-form"
        >
            @csrf
            @method("POST")
            <input type="hidden" name="user" value="{{$user->id}}">
        </form>

        <script type="text/javascript">
            const passwordResetForm = () => {
                let result = confirm("Czy na pewno chcesz to zrobić?");
                if(result) {
                    document.getElementById("password-reset-form").submit();
                }
                else
                    return false;
            }
        </script>

    </main>
@endsection
