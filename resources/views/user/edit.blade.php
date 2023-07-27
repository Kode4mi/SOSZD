@extends('templates.layout')

@section('content')
    <x-main-title>Zmień dane użytkownika {{$user->first_name}} {{$user->last_name}}</x-main-title>
    <main class="main-window edit_account user__main">
        <form action="/user-update" method="POST" class="user__form">

            <h3 class="user__form-title">Zmiana podstawowych danych:</h3>

            @csrf
            @method("PUT")

            <label for="email" class="user__form-label">Zmień e-mail:</label>
            <input type="text" id="email" class="user__input" placeholder="Email" name="email"
                   value="{{$user->email}}">


            @error('email')
            <p>{{$message}}</p>
            @enderror

            <label for="first_name" class="user__form-label">Zmień imię:</label>
            <input type="text" class="user__input" placeholder="Imie" id="first_name" name="first_name"
                   value="{{$user->first_name}}">

            @error('first_name')
            <p>{{$message}}</p>
            @enderror

            <label for="last_name" class="user__form-label">Zmień nazwisko:</label>
            <input type="text" class="user__input" placeholder="Nazwisko" id="last_name" name="last_name"
                   value="{{$user->last_name}}">

            @error('last_name')
            <p>{{$message}}</p>
            @enderror

            <label>Wybierz stanowisko:
                <select name="role">
                    <option value="nauczyciel">Nauczyciel</option>
                    <option value="admin"
                            @if($user->role === "admin")
                                selected
                        @endif
                    >Admin
                    </option>
                </select>
            </label>

            @error('role')
            <p>{{$message}}</p>
            @enderror

            <button type="submit" class="user__submit">Zatwierdź</button>

            <button type="button"
                    class="user__submit"
                    onclick="passwordResetForm()"
            >Wyślij email z resetem hasła
            </button>
            @error('password_reset')
            <p>{{$message}}</p>
            @enderror


            <button type="button"
                    class="user__delete"
                    onclick="deletionForm()"
            >
                Usuń użytkownika
            </button>


        </form>

        <form method="POST"
              action="/user/{{$user->id}}"
              id="user-delete-form"
        >
            @csrf
            @method('DELETE')
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
                if (result) {
                    document.getElementById("password-reset-form").submit();
                } else
                    return false;
            }

            const deletionForm = () => {
                let result = confirm("Czy na pewno chcesz to zrobić?");
                if (result) {
                    document.getElementById("user-delete-form").submit();
                } else
                    return false;
            }
        </script>

    </main>
@endsection
