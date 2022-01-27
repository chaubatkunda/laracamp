@component('mail::message')
    # Register Camp : {{ $checkout->camp->title }}

    Hi, {{ $checkout->user->name }}

    Thankyou for registered on camp: {{ $checkout->camp->title }}

    @component('mail::button', ['url' => route('dashboard')])
        Get Invoice
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
