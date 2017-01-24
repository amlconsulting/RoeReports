@extends('layouts.app')

@section('vendor-styles')
    <link href="{{ url('/vendors/datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection

@section('styles')
    <style>
        #invoiceClient {
            display: {{ (old('newClient') === 'on') ? 'block' : 'none' }};
        }

        #invoiceDetail tbody tr td {
            border: none;
        }

        #row-data {
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
                    <form action="{{ url('/llr/add-invoice') }}" method="post">
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
                                            <th class="col-lg-2 col-md-2 col-xs-2">Invoice Number</th>
                                            <th class="col-lg-2 col-md-2 col-xs-2">Client</th>
                                            <th class="col-lg-1 col-md-1 col-xs-1">New Client?</th>
                                            <th class="col-lg-2 col-md-2 col-xs-2">Invoice Date</th>
                                            <th class="col-lg-1 col-md-1 col-xs-1">Paid</th>
                                            <th class="col-lg-1 col-md-1 col-xs-1">Shipped</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group{{ $errors->has('invoiceNum') ? ' has-error' : '' }}">
                                                    <input name="invoiceNum" type="text" placeholder="Invoice Number" class="form-control input-sm" value="{{ old('invoiceNum') }}">
                                                    @if ($errors->has('invoiceNum'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('invoiceNum') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}">
                                                    <select id="client" name="client" class="form-control input-sm"{{ (old('newClient') === 'on') ? 'disabled': '' }}>
                                                        <option value=""></option>
                                                        @foreach($clients as $client)
                                                            <option value="{{ $client->id }}"{{ (old('client') === (string) $client->id) ? ' selected' : '' }}>{{ $client->name }} ({{ $client->email }})</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('client'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('client') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td><input type="checkbox" name="newClient" id="newClient"{{ (old('newClient') === 'on') ? ' checked': '' }}></td>
                                            <td>
                                                <div class="form-group{{ $errors->has('invoiceDate') ? ' has-error' : '' }}">
                                                    <input id="invoiceDate" name="invoiceDate" type="text" placeholder="Invoice Date" class="form-control input-sm" value="{{ old('invoiceDate') }}">
                                                    @if ($errors->has('invoiceDate'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('invoiceDate') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td><input type="checkbox" name="paid"{{ (old('paid') === 'on') ? ' checked': '' }}></td>
                                            <td><input type="checkbox" name="shipped"{{ (old('shipped') === 'on') ? ' checked': '' }}></td>
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
                                            <th class="col-lg-2 col-md-2 col-xs-2">Client Name</th>
                                            <th class="col-lg-2 col-md-2 col-xs-2">Client Email</th>
                                            <th class="col-lg-2 col-md-2 col-xs-2">Address 1</th>
                                            <th class="col-lg-2 col-md-2 col-xs-2">Address 2</th>
                                            <th class="col-lg-2 col-md-2 col-xs-2">City</th>
                                            <th class="col-lg-1 col-md-1 col-xs-1">State</th>
                                            <th class="col-lg-1 col-md-1 col-xs-1">Zip Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group{{ $errors->has('clientName') ? ' has-error' : '' }}">
                                                    <input name="clientName" type="text" placeholder="Name" class="form-control input-sm" value="{{ old('clientName') }}">
                                                    @if ($errors->has('clientName'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('clientName') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('clientEmail') ? ' has-error' : '' }}">
                                                    <input name="clientEmail" type="email" placeholder="Email" class="form-control input-sm" value="{{ old('clientEmail') }}">
                                                    @if ($errors->has('clientEmail'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('clientEmail') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('clientAddress1') ? ' has-error' : '' }}">
                                                    <input name="clientAddress1" type="text" placeholder="Address 1" class="form-control input-sm" value="{{ old('clientAddress1') }}">
                                                    @if ($errors->has('clientAddress1'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('clientAddress1') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('clientAddress2') ? ' has-error' : '' }}">
                                                    <input name="clientAddress2" type="text" placeholder="Address 2" class="form-control input-sm" value="{{ old('clientAddress2') }}">
                                                    @if ($errors->has('clientAddress2'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('clientAddress2') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('clientCity') ? ' has-error' : '' }}">
                                                    <input name="clientCity" type="text" placeholder="City" class="form-control input-sm" value="{{ old('clientCity') }}">
                                                    @if ($errors->has('clientCity'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('clientCity') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('clientState') ? ' has-error' : '' }}">
                                                    <input name="clientState" type="text" placeholder="State" class="form-control input-sm col-lg-2" value="{{ old('clientState') }}">
                                                    @if ($errors->has('clientState'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('clientState') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('clientZip') ? ' has-error' : '' }}">
                                                    <input name="clientZip" type="text" placeholder="Zip Code" class="form-control input-sm col-lg-2" value="{{ old('clientZip') }}">
                                                    @if ($errors->has('clientZip'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('clientZip') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
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
                                            <th class="col-lg-1">Total</th>
                                            <th class="col-lg-1">Tax</th>
                                            <th class="col-lg-1">Sub Total</th>
                                            <th class="col-lg-1">Discount</th>
                                            <th class="col-lg-1">Total Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                                                    <input name="total" type="text" placeholder="0.00" class="form-control input-sm" value="{{ old('total') }}">
                                                    @if ($errors->has('total'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('total') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('tax') ? ' has-error' : '' }}">
                                                    <input name="tax" type="text" placeholder="0.00" class="form-control input-sm" value="{{ old('tax') }}">
                                                    @if ($errors->has('tax'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('tax') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('subTotal') ? ' has-error' : '' }}">
                                                    <input name="subTotal" type="text" placeholder="0.00" class="form-control input-sm" value="{{ old('subTotal') }}">
                                                    @if ($errors->has('subTotal'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('subTotal') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                                                    <input name="discount" type="text" placeholder="0.00" class="form-control input-sm" value="{{ old('discount') }}">
                                                    @if ($errors->has('discount'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('discount') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('totalPaid') ? ' has-error' : '' }}">
                                                    <input name="totalPaid" type="text" placeholder="0.00" class="form-control input-sm" value="{{ old('totalPaid') }}">
                                                    @if ($errors->has('totalPaid'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('totalPaid') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <table id="invoiceDetail" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-lg-5 col-md-5 col-xs-5">Item</th>
                                            <th class="col-lg-3 col-md-3 col-xs-3">Size</th>
                                            <th class="col-lg-2 col-md-2 col-xs-2">Quantity</th>
                                            <th class="col-lg-2 col-md-2 col-xs-2">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @while(old('detail-' . $i . '-item'))
                                            <tr>
                                                <td>
                                                    <div class="form-group{{ ($errors->has('detail-' . $i . '-item')) ? ' has-error' : '' }}">
                                                        <select name="detail-{{ $i }}-item" class="form-control input-sm">
                                                            <option value=""></option>
                                                            @foreach($items as $item)
                                                                <option value="{{ $item->id }}"{{ (old('detail-' . $i . '-item') === (string) $item->id) ? ' selected' : '' }}>{{ $item->description }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('detail-' . $i . '-item'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('detail-' . $i . '-item') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group{{ ($errors->has('detail-' . $i . '-size')) ? ' has-error' : '' }}">
                                                        <select name="detail-{{ $i }}-size" class="form-control input-sm">
                                                            <option value=""></option>
                                                            @foreach($sizes as $size)
                                                                <option value="{{ $size->id }}"{{ (old('detail-' . $i . '-size') === (string)  $size->id) ? ' selected=selected' : '' }}>{{ $size->description }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('detail-' . $i . '-size'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('detail-' . $i . '-size') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group{{ ($errors->has('detail-' . $i . '-quantity')) ? ' has-error' : '' }}">
                                                        <input name="detail-{{ $i }}-quantity" type="text" placeholder="0" class="form-control input-sm" value="{{ old('detail-' . $i . '-quantity') }}">
                                                        @if ($errors->has('detail-' . $i . '-quantity'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('detail-' . $i . '-quantity') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group{{ ($errors->has('detail-' . $i . '-price')) ? ' has-error' : '' }}">
                                                        <input name="detail-{{ $i }}-price" type="text" placeholder="0.00" class="form-control input-sm" value="{{ old('detail-' . $i . '-price') }}">
                                                        @if ($errors->has('detail-' . $i . '-price'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('detail-' . $i . '-price') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endwhile
                                        <tr id="add-row-link">
                                            <td>
                                                <a href="#" id="add-row-link"><i class="fa fa-plus"></i> Item</a>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="submit" class="btn btn-primary" id="btn-save-new">Save & New</button>
                        </div>
                        <input type="hidden" id="saveNew" name="saveNew" value="0">
                    </form>
                    <div id="row-data">
                        <div id="data-item">
                            <select name="detail-###-item" class="form-control input-sm">
                                <option value=""></option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="data-size">
                            <select name="detail-###-size" class="form-control input-sm">
                                <option value=""></option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="data-quantity">
                            <input name="detail-###-quantity" type="text" placeholder="0" class="form-control input-sm">
                        </div>
                        <div id="data-price">
                            <input name="detail-###-price" type="text" placeholder="0.00" class="form-control input-sm">
                        </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = <?= $i-1 ?>;
            var newRow =
                '<tr>' +
                    '<td>' +
                        $('div#row-data div#data-item').html() +
                    '</td>' +
                    '<td>' +
                        $('div#row-data div#data-size').html() +
                    '</td>' +
                    '<td>' +
                        $('div#row-data div#data-quantity').html() +
                    '</td>' +
                    '<td>' +
                        $('div#row-data div#data-price').html() +
                    '</td>' +
                '</tr>';


            $('a#add-row-link').on('click', function() {
                counter++;
                $('tr#add-row-link').before(newRow.replace(/###/g, counter.toString()));
            });

            if(counter == 0) {
                $('a#add-row-link').click();
            }

            $('#invoiceDate').datepicker({
                todayBtn: "linked",
                daysOfWeekHighlighted: "1,2,3,4,5",
                autoclose: true,
                todayHighlight: true
            });
        });

        $('#newClient').change(function() {
            $('#client').prop('disabled', $(this).is(':checked')).val('');

            if($(this).is(':checked')) {
                $('#invoiceClient').slideDown('medium');
            } else {
                $('#invoiceClient').slideUp('medium');
            }
        });

        $('#btn-save-new').on('click', function() {
            $('#saveNew').val('1');
            $('form').submit();
        });
    </script>
@endsection