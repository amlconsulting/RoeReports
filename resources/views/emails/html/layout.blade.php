<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/RoeReports.css" rel="stylesheet">
    </head>
    <body>
        <h1>Hello, {{ $user->first_name }}!</h1>
        @yield('content')

        <p>
            Your Trusted LuLaRoe Reporting Experts,<br />
            RoeReports
        </p>

        <small>
            You are receiving this email because you have signed up on RoeReports.<br />
            Copyright &copy; {{ date('Y') }} {{ env('APP_NAME') }} - All Rights Reserved
        </small>
        <!-- Scripts -->
        <script src="/js/app.js"></script>
    </body>
</html>
