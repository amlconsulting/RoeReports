<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
Use GuzzleHttp;
use App\LuLaRoeCookies;

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
    public function addInvoice(Request $request) {
        $clients = $request->user()->clients()->get();

        return view('lularoe.invoice', [
            'clients' => $clients
        ]);
    }

}