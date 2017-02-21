<?php

namespace App\Http\Controllers;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Logs the user in and stores the session
     *
     * @param LaravelFacebookSdk $fb
     */
    public function login(LaravelFacebookSdk $fb) {
        $login_url = $fb->getLoginUrl(['email', 'user_managed_groups', 'publish_actions'], '/facebook/callback');
        echo '<a href="' . $login_url . '">Login with Facebook<a/>';
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
                $response = $fb->get('/me?fields=id')->getDecodedBody();
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }

            try {
                $groups = $fb->get('/' . $response['id'] . '/groups')->getDecodedBody();
                dd($groups['data']);
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }
    }
}