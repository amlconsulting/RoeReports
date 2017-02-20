@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                Awe man, we are sorry to see you go and hope you will return to us soon.<br /><br />
                In order to complete the cancellation of service, please complete the captcha and click Cancel Subscription.<br /><br />
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/subscription/cancel/' . $plan) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        {!! app('captcha')->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Cancel Subscription
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection