<!DOCTYPE html>
<html lang="en">
    @include('layouts.header')
    <body>
        <!-- Notification Area -->
        @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            {!! session('flash_notification.message') !!}
        </div>
        @endif

        @include('layouts.navigation')

        @yield('content')

        @include('layouts.footer')

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        @yield('bottom-scripts')
        <script src="{{ url('/js/RoeReports.js') }}"></script>
    </body>
</html>
