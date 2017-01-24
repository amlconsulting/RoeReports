<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
Use GuzzleHttp;
use App\LuLaRoeCookies;
use App\Invoices;
use App\InvoiceDetail;
use App\Clients;
use App\Item;
use App\Size;
use Carbon\Carbon;

class LuLaRoeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Log into LuLaRoe and retrieve session
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sessions(Request $request) {
        $user_credentials = $request->user()->lularoeCredentials()->get();

        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', env('LULAROE_SESSION_URL'), [
            'verify' => false,
            'query' => [
                '_token' => '',
                'email' => $user_credentials[0]->username,
                'password' => $user_credentials[0]->password
            ]
        ]);

        $http_cookies = $response->getHeader('Set-Cookie');
        $user_cookies = $request->user()->lularoeCookies()->get();

        if(count($user_cookies) > 0) {
            $user_cookies[0]->cookie = $http_cookies[0];
            $user_cookies[0]->save();
        } else {
            $lularoeCookie = new LuLaRoeCookies;
            $lularoeCookie->user_id = $request->user()->id;
            $lularoeCookie->cookie = $http_cookies[0];
            $lularoeCookie->save();
        }

        return view('lularoe.response', [
            'cookie' => $response->getHeader('Set-Cookie')
        ]);
    }

    /**
     * Bring up the edit form for the LuLaRoe Credentials
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function editLogin(Request $request) {
        return view('lularoe.editlogin', [
            'llr' => $request->user()->lularoeCredentials()->get()
        ]);
    }

    /**
     * Update the client's LuLaRoe Credentials
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateLogin(Request $request) {
        $validations = [];
        $user = $request->user();
        $current_credentials = $user->lularoeCredentials()->get();

        if($current_credentials[0]->username !== $request->input('username')) {
            $validations['username'] = 'required|email|max:255|unique:lularoe_credentials';
        }

        $validations['password'] = 'required|min:6|confirmed';

        if(count($validations) > 0){
            Validator::make($request->all(), $validations)->validate();

            $user->lularoeCredentials->username = $request->input('username');
            $user->lularoeCredentials->password = $request->input('password');
            $user->lularoeCredentials->save();

            flash('Your account was updated.', 'success');
        } else {
            flash('There were no updates made to your account.', 'warning');
        }

        return redirect('user/profile');
    }

    /**
     * Get the Add Invoice form
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function invoice(Request $request) {
        $clients = $request->user()->clients()->get();

        return view('lularoe.invoice', [
            'clients' => $clients,
            'items' => Item::all(),
            'sizes' => Size::all(),
            'old' => $request->old()
        ]);
    }

    /**
     * Add a new invoice
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function addInvoice(Request $request) {
        $inputs = $request->input();
        $user = $request->user();
        $validations = $this->getInvoiceValidations($inputs);
        $messages = [
            'required' => '*Required',
            'required_if' => '*Required',
            'required_with' => '*Required',
            'numeric' => 'Must be a number',
            'client.required_without' => '*Required if invoice is for existing client'
        ];

        Validator::make($inputs, $validations, $messages)->validate();

        DB::transaction(function() use ($inputs, $user) {

            $invoice = new Invoices;
            $invoice->user_id = $user->id;
            $invoice->invoiceNum = $inputs['invoiceNum'];
            $invoice->invoiceDate = Carbon::createFromFormat('m/d/Y', $inputs['invoiceDate']);

            //Get client
            if (isset($inputs['newClient']) && $inputs['newClient'] === 'on') {
                $client = new Clients;
                $client->name = $inputs['clientName'];
                $client->email = $inputs['clientEmail'];
                $client->address1 = $inputs['clientAddress1'];
                $client->address2 = $inputs['clientAddress2'];
                $client->city = $inputs['clientCity'];
                $client->state = $inputs['clientState'];
                $client->zipcode = $inputs['clientZip'];
                $client->user_id = $user->id;
                $client->save();

                $invoice->client_id = $client->id;
            } else {
                $invoice->client_id = $inputs['client'];
            }

            $invoice->total = $inputs['total'];
            $invoice->tax = $inputs['tax'];
            $invoice->subTotal = $inputs['subTotal'];
            $invoice->discount = $inputs['discount'];
            $invoice->totalPaid = $inputs['totalPaid'];
            $invoice->paid = (isset($inputs['paid']) && $inputs['paid'] === 'on') ? 1 : 0;
            $invoice->shipped = (isset($inputs['shipped']) && $inputs['shipped'] === 'on') ? 1 : 0;
            $invoice->save();

            $invoice_id = $invoice->id;

            $i = 1;

            while (isset($inputs['detail-' . $i . '-item']) && $inputs['detail-' . $i . '-item'] !== '') {
                $detail = new InvoiceDetail;
                $detail->invoiceHeader_id = $invoice_id;
                $detail->item_id = $inputs['detail-' . $i . '-item'];
                $detail->size_id = $inputs['detail-' . $i . '-size'];
                $detail->quantity = $inputs['detail-' . $i . '-quantity'];
                $detail->price = $inputs['detail-' . $i . '-price'];
                $detail->save();

                $i++;
            }

            flash('Your invoice was added.', 'success');
        });

        if ($inputs['saveNew'] === '1') {
            return redirect('llr/invoice', [
                'inputs' => []
            ]);
        } else {
            return redirect('dashboard/invoices');
        }
    }

    private function getInvoiceValidations($inputs) {
        $validations = [];

        //Invoice Validations
        $validations['invoiceNum'] = 'required|numeric|max:9999999999';
        $validations['client'] = 'required_without:newClient|integer';
        $validations['invoiceDate'] = 'required:date';

        //Client Validations
        $validations['clientName'] = 'required_if:newClient,on|max:255|string';
        $validations['clientEmail'] = 'required_if:newClient,on|email|max:255|string';
        $validations['clientAddress1'] = 'required_if:newClient,on|max:255|string';
        $validations['clientAddress2'] = 'max:255|string';
        $validations['clientCity'] = 'required_if:newClient,on|max:255|string|alpha';
        $validations['clientState'] = 'required_if:newClient,on|max:2|string|alpha';
        $validations['clientZip'] = 'required_if:newClient,on|max:10|alpha_dash';

        //Totals
        $validations['total'] = 'required|numeric';
        $validations['tax'] = 'required|numeric';
        $validations['subTotal'] = 'required|numeric';
        $validations['discount'] = 'numeric';
        $validations['totalPaid'] = 'required|numeric';

        //Details
        $i = 1;

        while (
            (isset($inputs['detail-' . $i . '-item']) && $inputs['detail-' . $i . '-item'] !== '') ||
            (isset($inputs['detail-' . $i . '-size']) && $inputs['detail-' . $i . '-size'] !== '') ||
            (isset($inputs['detail-' . $i . '-quantity']) && $inputs['detail-' . $i . '-quantity'] !== '') ||
            (isset($inputs['detail-' . $i . '-price']) && $inputs['detail-' . $i . '-price'] !== ''))
        {
            $validations['detail-' . $i . '-item'] = 'required_with:detail-' . $i . '-size,detail-' . $i . '-quantity,detail-' . $i . '-price';
            $validations['detail-' . $i . '-size'] = 'required_with:detail-' . $i . '-item,detail-' . $i . '-quantity,detail-' . $i . '-price';
            $validations['detail-' . $i . '-quantity'] = 'required_with:detail-' . $i . '-item,detail-' . $i . '-size,detail-' . $i . '-price|numeric';
            $validations['detail-' . $i . '-price'] = 'required_with:detail-' . $i . '-item,detail-' . $i . '-size,detail-' . $i . '-quantity|numeric';
            $i++;
        }

        return $validations;
    }

}