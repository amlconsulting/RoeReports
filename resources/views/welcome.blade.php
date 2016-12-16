@extends('layouts.app')

@section('styles')
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<style>
    html, body {
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
        font-weight: 100;
    }

    .m-b-md {
        margin-bottom: 60px;
    }
</style>
@endsection

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Welcome to {{ env('APP_NAME') }}!
        </div>
    </div>
</div>
@endsection