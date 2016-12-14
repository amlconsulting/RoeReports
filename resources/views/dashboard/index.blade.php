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
    </style>
@endsection

@section('content')
    <div class="navbar-default sidebar" role="navigation">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ url('dashboard/invoices') }}"><i class="fa fa-files-o fa-fw"></i> Invoices</a>
            </li>
            <li>
                <a href="{{ url('dashboard/sales') }}"><i class="fa fa-th-list fa-fw"></i> Sales</a>
            </li>
        </ul>
    </div>
    @yield('page')
@endsection

@section('bottom-scripts')
    <script src="{{ url('/vendors/metismenu/metisMenu.js') }}"></script>
    <script src="{{ url('/vendors/sb-admin/js/sb-admin-2.min.js') }}"></script>
@endsection
