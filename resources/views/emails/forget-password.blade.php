@component('mail::message')
# Reset hasła

@component('mail::button', ['url' =>"http://localhost:8000/reset-password/".$token])
    Resetuj hasło
@endcomponent


Pozdrawiamy,<br>
Zespół {{ config('app.name') }}
@endcomponent
