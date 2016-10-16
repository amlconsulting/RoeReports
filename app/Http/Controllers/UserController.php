<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * View the user's profile
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request) {
        return view('user.profile', ['user' => $request->getUser()]);
    }

    /**
     * Edit the user's profile
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        return view('user.edit', ['user' => $request->getUser()]);
    }

    /**
     * Update the user's profile
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

    }

    /**
     * Update the user's password
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request){

    }
}
