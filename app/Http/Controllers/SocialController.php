<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;



class SocialController extends Controller
{
    //for google callback
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->registerUserwithSocial($user);
        return redirect()->route('dashboard');
    }


    //for facebook callback
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->registerUserwithSocial($user);

        return redirect()->route('dashboard');
    }

    public function registerUserwithSocial($data)
    {
        $user = User::where('email', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->social_id = $data->id;
            $user->social_avatar = $data->avatar;
            $user->save();
        }
        $user->markEmailAsVerified();

        Auth::login($user);
    }
}
