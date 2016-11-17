@extends('layouts.app')

@section('styles')
<style>
    .user_attribute {
        padding-top: 7px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2">User Profile</div>
                        <div class="col-md-2 col-md-offset-8"><i class="fa fa-gear fa-fw">&nbsp;<a href="{{ url('/user/edit') }}"></i>Edit Profile</a></div>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6 user_attribute">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6 user_attribute">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="form-group">
                            <label for="notification_email" class="col-md-4 control-label">Notification E-Mail Address</label>
                            <div class="col-md-6 user_attribute">{{ Auth::user()->notification_email }}</div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2">Subscription Details</div>
                        <div class="col-md-2 col-md-offset-8"><i class="fa fa-gear fa-fw">&nbsp;<a href="{{ url('/subscription/edit') }}"></i>Change Subscription</a></div>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6 user_attribute"></div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label">Price</label>
                            <div class="col-md-6 user_attribute"></div>
                        </div>
                        <div class="form-group">
                            <label for="payment" class="col-md-4 control-label">Payment</label>
                            <div class="col-md-6 user_attribute">{{ Auth::user()->card_brand }} ending with {{ Auth::user()->card_last_four }}</div>
                        </div>
                        <div class="form-group">
                            <label for="renews_on" class="col-md-4 control-label">Renews On</label>
                            <div class="col-md-6 user_attribute"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
