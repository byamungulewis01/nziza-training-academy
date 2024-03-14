@component('mail::message')
# Welcome to {{ config('app.name') }}

Your new NZIZA MIS account have been created, credential are:

Email: {{ $email }} <br>
Password: {{ $password }}

@endcomponent
