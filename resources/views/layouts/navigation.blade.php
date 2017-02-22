        <nav class="navbar navbar-inverse navbar-static-top" id="main-nav">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ env('APP_NAME') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/subscription/view-plans') }}"><i class="fa fa-tags fa-fw"></i> Pricing</a></li>
                            <li><a href="{{ url('/facebook/login') }}"><i class="fa fa-sign-in fa-fw"></i> Facebook Login</a></li>
                        @else
                            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                            <li><a href="{{ url('/user/profile') }}"><i class="fa fa-user fa-fw"></i> Profile</a></li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-fw"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>