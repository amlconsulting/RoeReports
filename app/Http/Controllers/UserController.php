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
        $user = User::whereEmail($request->input('email'))->first();
        $validations = [];

        if($user->name !== $request->input('first_name')){
            $validations['first_name'] = 'required|max:255';
        }

        if($user->name !== $request->input('last_name')){
            $validations['last_name'] = 'required|max:255';
        }

        if($user->notification_email !== $request->input('notification_email')){
            $validations['notification_email'] = 'required|email|max:255|unique:users';
        }

        if(count($validations) > 0){
            Validator::make($request->all(), $validations)->validate();

            $user = User::whereEmail($request->input('email'))->first();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->notification_email = $request->input('notification_email');
            $user->save();

            flash('Your account was updated.', 'success');
        } else {
            flash('There were no updates made to your account.', 'warning');
        }

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

        $user = User::whereEmail($request->input('email'))->first();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        flash('Your password was changed.', 'success');

        return redirect('user/profile');
    }
}
