<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;


class FacebookController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
	
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
		//dd("hello");
        try{
            $user = Socialite::driver('facebook')->stateless()->user();
			//echo "<pre>"; print_r($user); die;
			$finduser = User::where('facebook_id', $user->id)->first();
			
			if($finduser){
     
                Auth::login($finduser);
    
                return redirect('/dashboard');
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
    
                Auth::login($newUser);
     
                return redirect('/dashboard');
            }
			
		} catch (Exception $e) {

            return redirect('/login')->with('message', 'Email Id Already Exit.');;

        }

        
		
    }
}