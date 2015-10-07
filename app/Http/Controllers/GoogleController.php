<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;

class GoogleController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('google')->user();

        // Check to see if this user exists in the database already.

        $user = User::where('email', $socialUser->email)->first();

        if (!$user)  {

            $user = new User();
            $user->username = $socialUser->nickname;
            $user->name = $socialUser->name;
            $user->email = $socialUser->email;
            $user->password = '';
            $user->avatar = $socialUser->avatar;
            $user->provider = 'google';
            $user->provider_id = $socialUser->id;
            $user->remember_token = $socialUser->token;
            $user->auth_key = '';
            $user->status = 1;

            $user->save();
        }

        Auth::login($user);

        return redirect('/dashboard');

    }

}
