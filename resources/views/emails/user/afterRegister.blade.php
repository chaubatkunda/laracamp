@component('mail::message')
    # Welsome

    Hi, {{ $user->name }}
    <br>
    Welcome to Laracamp, your account has been created successfully

    @component('mail::button', ['url' => route('login')])
        Login Here
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
