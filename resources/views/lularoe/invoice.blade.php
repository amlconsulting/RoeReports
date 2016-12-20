@extends('layouts.app')

@section('vendor-styles')
    <link href="{{ url('/vendors/datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection

@section('styles')
    <style>
        #invoiceClient {
            display: none;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add LuLaRoe Invoice</div>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" class="btn btn-primary" id="btn_save_new">Save & New</button>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="invoiceHeader" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th class="col-lg-2{{ $errors->has('invoiceNum') ? ' has-error' : '' }}">Invoice Number</th>
                                    <th class="col-lg-2{{ $errors->has('client') ? ' has-error' : '' }}">Client</th>
                                    <th class="col-lg-1">New Client?</th>
                                    <th class="col-lg-2{{ $errors->has('invoiceDate') ? ' has-error' : '' }}">Invoice Date</th>
                                    <th class="col-lg-1">Paid</th>
                                    <th class="col-lg-1">Shipped</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input name="invoiceNum" type="text" placeholder="Invoice Number" class="form-control input-sm">
                                        @if ($errors->has('invoiceNum'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('invoiceNum') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <select id="client" name="client" class="form-control input-sm">
                                            <option value=""></option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('client'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('client') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                    <td><input type="checkbox" name="newClient" id="newClient"></td>
                                    <td>
                                        <input id="invoiceDate" name="invoiceDate" type="text" placeholder="Invoice Date" class="form-control input-sm">
                                        @if ($errors->has('invoiceDate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('invoiceDate') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                    <td><input type="checkbox" name="paid"></td>
                                    <td><input type="checkbox" name="shipped"></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="row" id="invoiceClient">
                        <div class="col-lg-12">
                            <table class="table" width="100%">
                            <thead>
                                <tr>
                                    <th class="col-lg-2{{ $errors->has('clientName') ? ' has-error' : '' }}">Client Name</th>
                                    <th class="col-lg-2{{ $errors->has('clientEmail') ? ' has-error' : '' }}">Client Email</th>
                                    <th class="col-lg-2{{ $errors->has('clientAddress1') ? ' has-error' : '' }}">Address 1</th>
                                    <th class="col-lg-2{{ $errors->has('clientAddress2') ? ' has-error' : '' }}">Address 2</th>
                                    <th class="col-lg-2{{ $errors->has('clientCity') ? ' has-error' : '' }}">City</th>
                                    <th class="col-lg-1{{ $errors->has('clientState') ? ' has-error' : '' }}">State</th>
                                    <th class="col-lg-1{{ $errors->has('clientZip') ? ' has-error' : '' }}">Zip Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input name="clientName" type="text" placeholder="Name" class="form-control input-sm">
                                        @if ($errors->has('clientName'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('clientName') }}</strong>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <input name="clientEmail" type="email" placeholder="Email" class="form-control input-sm">
                                        @if ($errors->has('clientEmail'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('clientEmail') }}</strong>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <input name="clientAddress1" type="text" placeholder="Address 1" class="form-control input-sm">
                                        @if ($errors->has('clientAddress1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('clientAddress1') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <input name="clientAddress2" type="text" placeholder="Address 2" class="form-control input-sm">
                                        @if ($errors->has('clientAddress2'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('clientAddress2') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <input name="clientCity" type="text" placeholder="City" class="form-control input-sm">
                                        @if ($errors->has('clientCity'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('clientCity') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <input name="clientState" type="text" placeholder="State" class="form-control input-sm col-lg-2">
                                        @if ($errors->has('clientState'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('clientState') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <input name="clienZip" type="text" placeholder="Zip Code" class="form-control input-sm col-lg-2">
                                        @if ($errors->has('clienZip'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('clienZip') }}</strong>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <table id="invoiceHeader2" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th class="col-lg-1{{ $errors->has('total') ? ' has-error' : '' }}">Total</th>
                                        <th class="col-lg-1{{ $errors->has('tax') ? ' has-error' : '' }}">Tax</th>
                                        <th class="col-lg-1{{ $errors->has('subTotal') ? ' has-error' : '' }}">Sub Total</th>
                                        <th class="col-lg-1{{ $errors->has('discount') ? ' has-error' : '' }}">Discount</th>
                                        <th class="col-lg-1{{ $errors->has('totalPaid') ? ' has-error' : '' }}">Total Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input name="total" type="text" placeholder="$0.00" class="form-control input-sm">
                                            @if ($errors->has('total'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('total') }}</strong>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <input name="tax" type="text" placeholder="$0.00" class="form-control input-sm">
                                            @if ($errors->has('tax'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tax') }}</strong>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <input name="subTotal" type="text" placeholder="$0.00" class="form-control input-sm">
                                            @if ($errors->has('subTotal'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subTotal') }}</strong>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <input name="discount" type="text" placeholder="$0.00" class="form-control input-sm">
                                            @if ($errors->has('discount'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('discount') }}</strong>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <input name="totalPaid" type="text" placeholder="$0.00" class="form-control input-sm">
                                            @if ($errors->has('totalPaid'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('totalPaid') }}</strong>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" class="btn btn-primary" id="btn_save_new">Save & New</button>
                    </div>
                </div>
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
    <script src="{{ url('/vendors/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#invoiceHeader, #invoiceHeader2').DataTable({
                dom: '',
                ordering: false
            });

            $('#invoiceDate').datepicker({
                todayBtn: "linked",
                daysOfWeekHighlighted: "1,2,3,4,5",
                autoclose: true,
                todayHighlight: true
            });
        });

        $('#btn-save-new').click(function() {
            $('#saveNew').value("1");
            $('form').submit();
        });

        $('#newClient').change(function() {
            $('#client').prop('disabled', $(this).is(':checked')).val('');

            if($(this).is(':checked')) {
                $('#invoiceClient').slideDown('medium');
            } else {
                $('#invoiceClient').slideUp('medium');
            }
        });
    </script>
@endsection