<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Laravel\Socialite\Facades\Socialite;
use App\SocialAccountService;
use App\User;
use Auth;

class SocialAuthController extends Controller
{
    
	public function redirect($provider)
	{
       
		return Socialite::driver($provider)->redirect();    
       
	}
 

    public function callback(SocialAccountService $service, $provider)
    {
        
        $socialiteUser = Socialite::with($provider)->stateless()->user();

       
         if(User::where('email', '=', $socialiteUser->email)->first()){
            
            $checkUser = User::where('email', '=', $socialiteUser->email)->first();
            Auth::login($checkUser);
            return redirect('');
         }


        $user = $this->findOrCreateUser($socialiteUser,$provider);
        
        auth()->login($user);
	    return redirect()->back(); 
        
        
    }


    public function findOrCreateUser($socialMediaUser,$provider)
    {
          
    	$user = User::where('provider_id', $socialMediaUser->getId())->first();
    	
    	if(is_null($user)) {
    		
    		$user = User::create([
    			'provider_id' => $socialMediaUser->getId(),
    			'name' => $socialMediaUser->getName(),
    			'provider' => $provider,
                'is_active' => 1,
                'mobile' => '',
    			'email' => $socialMediaUser->getEmail(),
                'username' => strstr($socialMediaUser->getEmail(), '@', true),
                'access_token' => $socialMediaUser->token,
                'password' => Hash::make('om@#123')
            ]);
    	}



    	return $user;

    }

}
