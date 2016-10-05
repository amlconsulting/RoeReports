<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use App\ActivationService;

class SocialAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service){
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        if(!$user->activated){
            ActivationService::sendActivationMail($user);
            Auth::logout();

            return back()->with('warning', 'You need to confirm your account. We have sent you an email with an activation code.');
        }

        Auth::login($user, true);

        return redirect()->to('/home');
    }
}
