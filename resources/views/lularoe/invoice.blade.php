@extends('layouts.app')

@section('styles')
    <style>
        #newClientForm {
            display: none;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add LuLaRoe Invoice</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/llr/add-invoice') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1 form-group{{ $errors->has('invoiceNum') ? ' has-error' : '' }}">
                                <label>Invoice Number</label>
                                <input name="invoiceNum" type="text" placeholder="Invoice Number" class="form-control">
                                @if ($errors->has('invoiceNum'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoiceNum') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="client">Client</label>
                            <div class="col-md-4">
                                <select id="client" name="client" class="form-control">
                                    <option value=""></option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                                    @endforeach
                                </select>
                                <input type="hidden">
                                <label class="checkbox-inline" for="newClient">
                                    <input type="checkbox" name="newClient" id="newClient">
                                    New Client
                                </label>
                                @if ($errors->has('client'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('client') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <fieldset id="newClientForm">
                            <div class="form-group{{ $errors->has('clientName') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="invoiceNum">Name</label>
                                <div class="col-md-4">
                                    <input name="clientName" type="text" placeholder="Name" class="form-control input-md">
                                    @if ($errors->has('clientName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('clientName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('clientEmail') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="clientEmail">Email</label>
                                <div class="col-md-4">
                                    <input name="clientEmail" type="text" placeholder="Email" class="form-control input-md">
                                    @if ($errors->has('clientEmail'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('clientEmail') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('clientAddress1') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="clientAddress1">Address 1</label>
                                <div class="col-md-4">
                                    <input name="clientAddress1" type="text" placeholder="Address 1" class="form-control input-md">
                                    @if ($errors->has('clientAddress1'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('clientAddress1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('clientAddress2') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="clientAddress2">Address 2</label>
                                <div class="col-md-4">
                                    <input name="clientAddress2" type="text" placeholder="Address 2" class="form-control input-md">
                                    @if ($errors->has('clientAddress2'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('clientAddress2') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('clientCity') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="clientAddress2">City</label>
                                <div class="col-md-2">
                                    <input name="clientCity" type="text" placeholder="City" class="form-control input-md">
                                    @if ($errors->has('clientCity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('clientCity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('clientState') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="clientState">State</label>
                                <div class="col-md-2">
                                    <input name="clientState" type="text" placeholder="State" class="form-control input-md">
                                    @if ($errors->has('clientState'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('clientState') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('clienZip') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label" for="clientState">Zip Code</label>
                                <div class="col-md-2">
                                    <input name="clienZip" type="text" placeholder="Zip Code" class="form-control input-md">
                                    @if ($errors->has('clienZip'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('clienZip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="checkboxes"></label>
                            <div class="col-md-4">
                                <label class="checkbox-inline" for="paid">
                                    <input type="checkbox" name="paid">
                                    Shipped
                                </label>
                                <label class="checkbox-inline" for="shipped">
                                    <input type="checkbox" name="shipped">
                                    Paid
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-lg-offset-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="submit" class="btn btn-primary" id="btn_save_new">Save & New</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-scripts')
    <script>
        $('#btn-save-new').click(function(){
            $('#saveNew').value("1");
            $('form').submit();
        });

        $('#newClient').change(function() {
            $('#client').prop('disabled', $(this).is(':checked')).val('');

            if($(this).is(':checked')) {
                $('#newClientForm').slideDown('medium');
            } else {
                $('#newClientForm').slideUp('medium');
            }
        });
    </script>
@endsection