@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">LuLaRoe Login</div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('/llr/sessions') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input class="form-control" type="text" placeholder="Email Address" name="email"><br>
                        <input class="form-control" placeholder="Password" name="password" type="password" value=""><br>
                        <button class='btn btn-primary'>Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
