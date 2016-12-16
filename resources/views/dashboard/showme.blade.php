@extends('dashboard.index')

@section('page')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                Invoice: {{ $invoice }}<br>
                Client: {{ $invoice->client }}<br>
                Details:<br>
                @foreach($invoice->invoiceDetail as $detail)
                    {{ $detail }}<br>
                @endforeach
            </div>
        </div>
    </div>
@endsection