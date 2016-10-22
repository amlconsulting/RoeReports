@extends('emails.html.layout')

@section('content')
<p>Thanks for signing up to RoeReports!</p>
<p>We just need you to confirm your email address. Please click <a href='{{ url("register/confirm/{$user->activation_token}") }}'>here</a> to confirm.</p>
<p>If that link doesn't work, please paste the link below into your favorite browser to confirm your email.</p>
<p>{{ url("register/confirm/{$user->activation_token}") }}</p>
@endsection
