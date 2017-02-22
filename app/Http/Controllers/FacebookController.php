<?php

namespace App\Http\Controllers;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;
use App\User;
use App\Http\Controllers\EmailController as Email;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Logs the user in and stores the session
     *
     * @param LaravelFacebookSdk $fb
     * @return \HttpResponse
     */
    public function login(LaravelFacebookSdk $fb) {
        $login_url = $fb->getLoginUrl(['email', 'user_managed_groups', 'publish_actions'], '/facebook/callback');
        return redirect($login_url);
    }

    /**
     * Callback after Facebook login
     *
     * @param LaravelFacebookSdk $fb
     */
    public function callback(LaravelFacebookSdk $fb) {
        try {
            $token = $fb->getRedirectLoginHelper()->getAccessToken();
        } catch (FacebookSDKException $e) {
            dd($e->getMessage());
        }

        if($token) {
            $fb->setDefaultAccessToken($token);

            try {
                $response = $fb->get('/me?fields=id,name,email')->getDecodedBody();
                $user = User::whereEmail($response['email'])->first();

                if(!$user){
                    $user = User::create([
                        'name' => $response['name'],
                        'facebook_id' => $response['id'],
                        'facebook_access_token' => (string) $token,
                        'email' => $response['email'],
                        'notification_email' => $response['email']
                    ]);

                    Email::send('welcome', $user);
                } else {
                    $user->facebook_access_token = (string) $token;
                    $user->save();
                }
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }

            Auth::login($user, true);

            return redirect('/dashboard');

            /*try {
                $groups = $fb->get('/' . $user->facebook_id . '/groups')->getDecodedBody();
                dd($groups['data']);
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }*/
        }
    }
}