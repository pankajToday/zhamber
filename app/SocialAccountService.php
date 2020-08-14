<?php

namespace App;

use Laravel\Socialite\Contracts\Provider;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {
        
        $providerUser = $provider->user();
        $providerName = class_basename($provider); 

        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'provider' => $provider,
                    'is_active' => 1,
                    'mobile' => '',
                    'username' => strstr($socialMediaUser->getEmail(), '@', true),
                    'access_token' => $socialMediaUser->token,
                    'password' => Hash::make('om@#123')
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}