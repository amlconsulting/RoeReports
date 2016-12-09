@extends('layouts.app')

@section('styles')
<link href="/css/pricetables.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 center">
            @foreach($plans as $plan)
                <div class="pricing-table {{ ($plan['metadata']['featured'] === 'yes') ? 'featured' : '' }}">
                    <div class="pricing-table-header">
                        <h1>{{ $plan['name'] }}</h1>
                    </div>
                    <div class="pricing-table-content">
                        <ul>
                            <li>Feature 1</li>
                            <li>Feature 2</li>
                            <li>Feature 3</li>
                            <li>Feature 4</li>
                        </ul>
                    </div>
                    <div class="pricing-table-footer">
                        <h2><sup>$</sup>{{ $plan['amount'] / 100 }}</h2>
                        <p>per {{ $plan['interval'] }}</p>
                        <form action="{{ url('subscription/subscribe/' . $plan['id']) }}" method="POST">
                            {{ csrf_field() }}
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_PUBLIC') }}"
                                data-amount="{{ $plan['amount']}}"
                                data-name="{{ env('APP_NAME') }}"
                                data-description="{{ $plan['name'] }}"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto"
                                data-email="{{ Auth::user()->email }}"
                                data-label="Select"
                                data-allowRememberMe="false"
                                data-billingAddress="true">
                            </script>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div
</div>
@endsection
