<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Request;
use Socialite;
use Validator;

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

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'                => 'required|email|max:255|unique:users',
            'password'             => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected $redirectPath = '/home';

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->scopes(['email'])->user();
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/');
    }

    /**
     * Return user if exists; create and return if doesn't.
     *
     * @param $facebookUser
     *
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('facebook_id', $facebookUser->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name'        => $facebookUser->name,
            'email'       => $facebookUser->email,
            'facebook_id' => $facebookUser->id,
            'avatar'      => $facebookUser->avatar,
        ]);
    }
}
