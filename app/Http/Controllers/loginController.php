<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class loginController extends Controller
{
   public function redirctToProvider($provider){
      return Socialite::driver($provider)->redirect();
    
   }
   public function handleProviderCallback($provider)
   {
     $user = Socialite::driver($provider)->user();
     $existingUser = User::whereEmail($user->getEmail())->first();

     if($existingUser){
        Auth::login($existingUser);
     }else{
        $newUser = User::updateOrCreate([
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'password'=> Hash::make('11111111'),
        ]);
         Auth::login($newUser);
     }
     return redirect()->route('home');
   }
}
