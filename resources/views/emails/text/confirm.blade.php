@extends('emails.text.layout')

@section('content')
Thanks for signing up to RoeReports!

We just need you to confirm your email address. Please paste the link below into your favorite browser to confirm your email.

{{ url("register/confirm/{$user->activation_token}") }}
@endsection