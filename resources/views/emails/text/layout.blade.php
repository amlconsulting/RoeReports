{{ env('APP_NAME') }}

Hello, {{ $user->name }}!

@yield('content')

Your Trusted LuLaRoe Reporting Experts,
RoeReports

You are receiving this email because you have signed up on RoeReports.
Copyright {{ date('Y') }} {{ env('APP_NAME') }} - All Rights Reserved