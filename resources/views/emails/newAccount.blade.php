@component('mail::message')
    # Welcome to {{ config('app.name') }}

    Your new NZIZA MIS account have been created, credential are:

    Email: {{ $email }} <br>
    Password: {{ $password }}
    <br>
    Click here to login <a href="https://nzizamis.com/login" target="_blank">Employee Operations Management System</a>
@endcomponent
