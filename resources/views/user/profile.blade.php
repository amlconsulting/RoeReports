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
                        <div class="col-md-6">User Profile</div>
                        <div class="col-md-6 right"><i class="fa fa-gear fa-fw">&nbsp;</i><a href="{{ url('/user/edit') }}">Edit Profile</a></div>
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
                        <div class="col-md-6">Subscription Details</div>
                        <div class="col-md-6 right"><i class="fa fa-gear fa-fw">&nbsp;</i><a href="{{ url('/subscription/plans') }}">Change Subscription</a></div>
                    </div>
                </div>
                <div class="panel-body">
                    @if($subscribed)
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
                    @elseif($onTrial)
                        <div class="row">
                            <div class="col-md-12 center">You are currently on a trial. Your trial ends at <strong>{{ Carbon\Carbon::parse(Auth::user()->trial_ends_at)->format('g:i a') }}</strong> on <strong>{{ Carbon\Carbon::parse(Auth::user()->trial_ends_at)->format('m-d-Y') }}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 center">If you would like to sign up for service, please click <a href="{{ url('/subscription/plans') }}">here</a>.</div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12 center">You are not subscribed or your trial period has ended. If you would like to sign up for service, please click <a href="{{ url('/subscription/plans') }}">here</a>.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
