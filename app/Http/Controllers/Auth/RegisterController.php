<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\EmailController as Email;


class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'notification_email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        Email::send('confirm', $user);
        flash('You have been registered. Please confirm your email.', 'success');
        return redirect($this->redirectPath());
    }

    /**
     * Confirms the user's email address and activates the user's account
     *
     * @param String $activation_token
     * @return mixed
     */
    public function confirm($activation_token) {
        $user = User::whereActivation_token($activation_token)->firstOrFail();
        $user->activateUser();
        Email::send('welcome', $user);
        flash('Your email has been confirmed. Please log in.', 'success');
        return redirect('/login');
    }

    /**
     * Create a random password.
     *
     * @return String $password
     */
    private function createRandomPassword(){
        $passwordLength = 15;
        $sets = [
            'upperAlpha' => 'ABCDEFGHJKMNPQRSTUVWXYZ',
            'lowerAlpha' => 'abcdefghjkmnpqrstuvwxyz',
            'number' => '23456789',
            'symbol' => '!@#$%&*?'
        ];

        $all = "";
        $password = "";

        foreach($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);

        for($i = 0; $i < $passwordLength - count($sets); $i++){
            $password .= $all[array_rand($all)];
        }

        return  str_shuffle($password);
    }

}
