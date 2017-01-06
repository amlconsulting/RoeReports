@extends('layouts.app')

@section('vendor-styles')
    <link href="{{ url('/vendors/datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection

@section('styles')
    <style>
        #invoiceClient {
            display: none;
        }

        #invoiceDetail tbody tr td {
            border: none;
        }

        #row-data {
            display: none;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add LuLaRoe Invoice Results</div>
                <div class="panel-body">
                    {{ var_dump($inputs) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection