<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service){
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        Auth::login($user, true);

        return redirect()->to('/dashboard');
    }
}
