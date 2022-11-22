@component('mail::message')
# Ustaw hasło do swojego konta w {{ config('app.name') }}.

@component('mail::button', ['url' =>"http://localhost:8000/create-password/".$token])
    Stwórz hasło
@endcomponent


Pozdrawiamy,<br>
Zespół {{ config('app.name') }}
@endcomponent
