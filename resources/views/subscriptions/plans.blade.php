@extends('layouts.app')

@section('styles')
<link href="/css/pricetables.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @foreach($plans['data'] as $plan)
                {{ var_dump($plan) }}
                <div class="pricing-table">
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
                        <a href="{{ url('subscription/signup/' . $plan['id']) }}">Sign Up</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
