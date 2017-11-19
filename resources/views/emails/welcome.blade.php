@component('mail::message')
# {{ $user->name }}

Thanks for create your account, please verify your email:

@component('mail::button', ['url' => route('user_verify', $user->verification_token)])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
