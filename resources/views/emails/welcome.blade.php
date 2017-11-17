{{ $user->name }}

Thanks for create your account, please verify your email here:

<a href={{ route('user_verify', $user->verification_token) }}>Click Here</a>
