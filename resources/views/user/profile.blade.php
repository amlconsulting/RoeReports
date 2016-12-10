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
        <div class="col-md-10 col-md-offset-1">
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
                            <label for="name" class="col-md-6 control-label">Name</label>
                            <div class="col-md-6 user_attribute">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-6 control-label">E-Mail Address</label>
                            <div class="col-md-6 user_attribute">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="form-group">
                            <label for="notification_email" class="col-md-6 control-label">Notification E-Mail Address</label>
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
                        @if($onGracePeriod)
                            <div class="row">
                                <div class="col-md-12 center">
                                    You are set to be canceled after your {{ ($onTrial) ? 'trial' : 'current' }} period. You will not be charged after your {{ ($onTrial) ? 'trial' : 'current' }} period ends.
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 center">
                                    Click <a href="{{ url('subscription/resume') }}">here</a> to resume your subscription so you don't miss out.
                                </div>
                            </div>
                        @elseif($onTrial)
                            <div class="row">
                                <div class="col-md-12 center">
                                    You are on trial and have not been charged yet. You will be charged after your trial period ends.
                                </div>
                            </div>
                        @endif
                        <form class="form-horizontal" id="payment-form" action="{{ url('subscription/update-card') }}" method="POST">
                            <div class="form-group">
                                <label for="plan" class="col-md-6 control-label">Plan</label>
                                <div class="col-md-5 user_attribute">{{ $plan->name }} (${{ $plan->amount / 100 }}/{{ $plan->interval }})</div>
                            </div>
                            <div class="form-group">
                                <label for="payment" class="col-md-6 control-label">Payment</label>
                                <div class="col-md-5 user_attribute">
                                    {{ Auth::user()->card_brand }} ending in {{ Auth::user()->card_last_four }}&nbsp;
                                    <script src="https://checkout.stripe.com/checkout.js"></script>
                                    <a href="javascript:;" id="edit-card">edit</a>
                                    {{ csrf_field() }}
                                    <script>
                                        var handler = StripeCheckout.configure({
                                            key: '{{ env('STRIPE_PUBLIC') }}',
                                            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                                            locale: 'auto',
                                            token: function(token) {
                                                $('#payment-form')
                                                    .append('<input type="hidden" name="stripeToken" value="' + token.id + '">')
                                                    .submit();
                                            }
                                        });

                                        document.getElementById('edit-card').addEventListener('click', function(e) {
                                            // Open Checkout with further options:
                                            handler.open({
                                                name: '{{ env('APP_NAME') }}',
                                                email: '{{ Auth::user()->notification_email }}',
                                                panelLabel: 'Update Card Details',
                                                allowRememberMe: false,
                                                billingAddress: true
                                            });
                                            e.preventDefault();
                                        });

                                        // Close Checkout on page navigation:
                                        window.addEventListener('popstate', function() {
                                            handler.close();
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="renews_on" class="col-md-6 control-label">Period Ends</label>
                                @if($onTrial)
                                    <div class="col-md-6 user_attribute">{{ Carbon\Carbon::parse($subscription->trial_ends_at)->format('m-d-Y') }} at {{ Carbon\Carbon::parse($subscription->trial_ends_at)->format('g:i a') }}</div>
                                @else
                                    <div class="col-md-6 user_attribute">{{ Carbon\Carbon::parse($subscription->ends_at)->format('m-d-Y') }} at {{ Carbon\Carbon::parse($subscription->ends_at)->format('g:i a') }}</div>
                                @endif
                            </div>
                        </form>
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
