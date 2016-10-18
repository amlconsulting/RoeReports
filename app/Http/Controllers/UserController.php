<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Validator;

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
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'notification_email' => 'required|email|max:255|unique:users'
        ])->validate();

        //$this->validator($request->all())->validate();

        $user = User::whereEmail($request->input('email'))->first();
        $user->name = $request->input('name');
        $user->notification_email = $request->input('notification_email');
        $user->save();

        return redirect('user/profile');
    }

    /**
     * Update the user's password
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request){
        Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed'
        ])->validate();

        //$this->validator($request->all())->validate();

        $user = User::whereEmail($request->input('email'))->first();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect('user/profile');
    }
}
