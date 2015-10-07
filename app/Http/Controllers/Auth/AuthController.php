<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Event;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;



    protected $redirectPath = '/registration-complete';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        //  Has the user already registered with a social media service?
         return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $user = new User();

        $user->name = $data['first_name'] .' '. $data['last_name'];
        $user->username = '';
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->avatar = '';
        $user->provider = 'standard';
        $user->provider_id = '';
        $user->remember_token = '';
        $user->auth_key = sha1(microtime());
        $user->status = 0;


        $user->save();


//        return User::create([
//            'name' => $data['first_name'] .' '. $data['last_name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//            'provider' => 'standard',
//            'auth_key' => $auth_key
//
//        ]);

        Event::fire(new UserCreated($user));

        return $user;
    }
}
