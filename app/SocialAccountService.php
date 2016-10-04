<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService{
    public function createOrGetUser(ProviderUser $providerUser){
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if($account){
            return User::whereEmail($providerUser->getEmail())->first();
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if(!$user){
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => bcrypt(rand(10, 15))
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
