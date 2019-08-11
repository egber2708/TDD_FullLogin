<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function RedirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }


 

   public function handleProviderCallback($provider)
   {
        try{
                $userSocial = Socialite::driver($provider)->user();
            } catch (Exception $e) {
                abort(403, 'Unauthorized action.');
                return redirect()->to('/');
            }
            $user = User::firstOrCreate(
                ['provider'    => $provider,
                 'provider_id' => $userSocial->getId()], 
                 [
                    'provider' => $provider,
                    'provider_id' => $userSocial->getId(),
                    'name' => $userSocial->getName(),
                    'nickname'=>$userSocial->getNickname(),
                    'email' => $userSocial->getEmail(),
                    'avatar'  => $userSocial->avatar,
                ]);

            Auth::login($user);
            return redirect()->to($this->redirectTo);
   }


}
