<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;;
use Illuminate\Http\Request;

use Socialite;
use App\SocialProvider;
use App\User;
use DB;

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


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $dirver = Socialite::driver($provider)->stateless();
        $userProvider = $dirver->user();
        $user_result = null;

        // check if token exists
        $user_has_token = $dirver->userFromToken($userProvider->token);
        if ($user_has_token == null) {
            return redirect('/');
        }

        // check of social exsits
        $account_social_provider = SocialProvider::where('provider', $provider)
                                                ->where('provider_id', $userProvider->getId())
                                                ->first();
        // return auth token on social account if exists
        if ($account_social_provider) {
            return redirect('/get_token_socialite' . $this->issueToken($account_social_provider->user))->with('status_active', true);
        }

        // check user exists
        $user = User::where('email', $userProvider->getEmail())->first();
        $new_social_provider_data = [
            'provider' => $provider,
            'provider_id' => $userProvider->getId()
        ];
        $user_data = [
            'email' => $userProvider->getEmail(),
            'name' => $userProvider->getName() ?? $userProvider->getEmail(),
            'photo' => $userProvider->getAvatar() ?? 'images/user-avatar/default-avatar.png'
        ];

        // add social account if user exists
        if ($user) {
            // create new provider
            $this->addNewSocialProvider($user, $new_social_provider_data);

            $user_result = $user;

        // add user and social account if not user exists
        } else {
            $newUser = User::create($user_data);
            $this->addNewSocialProvider($newUser, $new_social_provider_data);
            $user_result = $newUser;
        }

        return redirect('/get_token_socialite' . $this->issueToken($user_result))->with('status_active', true);
    }

    private function issueToken($user) {
        $oldToken = DB::table('oauth_access_tokens')->where('user_id', $user->id)->where('name', 'social');
        if ($oldToken->count() > 0) {
            $oldToken->delete();
        }
        $token = $user->createToken('social');
        // dd($user);
        $accessToken = $token->accessToken;
        return '?access_token=' . $accessToken;
    }

    private function addNewSocialProvider($user, $data) {
        $user->socialProviders()->create($data);
    }

}
