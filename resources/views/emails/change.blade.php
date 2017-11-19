{{ $user->name }}

You have changed you email, please verify your new email here:

<a href={{ route('user_verify', $user->verification_token) }}>Click Here</a>
