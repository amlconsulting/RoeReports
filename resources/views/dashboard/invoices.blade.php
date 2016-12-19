@extends('dashboard.index')

@section('vendor-styles')
    @parent
    <link href="{{ url('/vendors/datatables/plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('/vendors/datatables/responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('page')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Invoices</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="invoice-datatable">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Client</th>
                                    <th>Invoice Date</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
                                    <th>Sub Total</th>
                                    <th>Total Paid</th>
                                    <th class="none">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoiceNum }}</td>
                                        <td>{{ $invoice->client->name }}</td>
                                        <td>{{ $invoice->invoiceDate }}</td>
                                        <td>${{ $invoice->total }}</td>
                                        <td>${{ $invoice->discount }}</td>
                                        <td>${{ $invoice->tax }}</td>
                                        <td>${{ $invoice->subTotal }}</td>
                                        <td>${{ $invoice->totalPaid }}</td>
                                        <td>
                                            <table width="100%" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Size</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($invoice->invoiceDetail as $detail)
                                                        <tr>
                                                            <td>{{ $detail->item->description }}</td>
                                                            <td>{{ $detail->size->description }}</td>
                                                            <td>{{ $detail->quantity }}</td>
                                                            <td>${{ $detail->price }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Detail Model -->
    <div id="invoice-detail-modal" class="modal fade" tabindex="1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Invoice Details</h4>
                </div>
                <div class="modal-body">
                    <p>This is where the invoice details will go.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    @parent
    <script src="{{ url('/vendors/datatables/base/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/vendors/datatables/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ url('/vendors/datatables/responsive/dataTables.responsive.js') }}"></script>
    <script>
        $(document).ready(function() {
            console.log('{{ $invoices }}')
            $('#invoice-datatable').DataTable({
                responsive: true,
                columnDefs: [
                    {
                        targets: [ 3 ],
                        visible: false,
                        searchable: false
                    }
                ]
            });
        });

        function showInvoiceData(invoiceNum) {
            $('#invoice-detail-modal').modal('show');
        }
    </script>
@endsection