@extends('dashboard.index')

@section('vendor-styles')
    @parent
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('styles')
    @parent
    <style>
        #invoiceChart {
            height: 250px;
        }
    </style>
@endsection

@section('page')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Sales Trend</div>
                    <div class="panel-body">
                        <div id="invoiceChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        new Morris.Bar({
            element: 'invoiceChart',
            data: [
                @foreach($invoices as $invoice)
                { invoiceDate: '{{ $invoice->invoiceDate }}', totalPaid: '{{ $invoice->totalPaid }}' },
                @endforeach
            ],
            xkey: 'invoiceDate',
            ykeys: ['totalPaid'],
            labels: ['Sale $'],
            xLabels: "month",
            xLabelFormat: function(x){
                var date = new Date(x);
                return months[(date.getMonth())] + ' ' + date.getFullYear().toString().substr(2, 2);
            },
            yLabelFormat: function(y){
                return '$' + y.toFixed(2);
            }
        });
    </script>
@endsection