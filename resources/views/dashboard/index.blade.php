@extends('layouts.app')

@section('vendor-styles')
    <link href="{{ url('/vendors/metismenu/metisMenu.css') }}" rel="stylesheet">
    <link href="{{ url('/vendors/sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
@endsection

@section('styles')
    <style>
        #main-nav {
            margin-bottom: 0px;
        }

        .navbar {
            min-height: 0px;
        }

        .sidebar ul li {
            background-color: #F5F5F5;
        }
    </style>
@endsection

@section('content')
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard/invoices') }}"><i class="fa fa-files-o fa-fw"></i> Invoices</a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard/sales') }}"><i class="fa fa-tags fa-fw"></i> Sales</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('page')
    </div>
@endsection

@section('bottom-scripts')
    <script src="{{ url('/vendors/metismenu/metisMenu.js') }}"></script>
    <script src="{{ url('/vendors/sb-admin/js/sb-admin-2.min.js') }}"></script>
@endsection
