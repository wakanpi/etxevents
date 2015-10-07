<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FacebookController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('facebook')->user();

        // Check to see if this user exists in the database already.

        $user = User::where('email', $socialUser->email)->first();

        if (!$user)  {

            $user = new User();
            $user->username = $socialUser->nickname;
            $user->name = $socialUser->name;
            $user->email = $socialUser->email;
            $user->password = '';
            $user->avatar = $socialUser->avatar;
            $user->provider = 'facebook';
            $user->provider_id = $socialUser->id;
            $user->remember_token = '';
            $user->auth_key = '';
            $user->status = 1;

            $user->save();
        }

        Auth::login($user);

        return redirect('/dashboard');

    }

}
