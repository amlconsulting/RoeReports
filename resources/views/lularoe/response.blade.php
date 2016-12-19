@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">LuLaRoe Login Response</div>
                <div class="panel-body">
                    Cookie: {{ $cookie[0] }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
