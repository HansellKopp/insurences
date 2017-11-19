@component('mail::message')
# {{ $user->name }}

You have changed you email, please verify your new email here:

@component('mail::button', ['url' => route('user_verify', $user->verification_token)])
Confirm
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
