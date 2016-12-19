<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

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
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://mylularoe.com/sessions',
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_HEADER => 1,
            CURLOPT_POSTFIELDS => [
                '_token' => '',
                'email' => $user_credentials[0]->username,
                'password' => $user_credentials[0]->password
            ]
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        $pattern  = "/^Set-Cookie:\s*(.*); expires=[a-z]{3},\s*([^;]*);/mi";
        preg_match_all($pattern, $response, $matches);

        //$cookie = $matches[1][0];
        //$expires = new DateTime($matches[2][0]);

        return view('lularoe.response', [
            'response' => $matches
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

}