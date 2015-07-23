<?php
/**
 * Created by PhpStorm.
 * User: German
 * Date: 16/07/2015
 * Time: 11:14 AM
 */

namespace App\Http\Controllers\Frontend\Auth;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;


class ProviderSocialAuth
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var Socialite
     */
    private $socialite;
    /**
     * @var Authenticatable|Guard
     */
    private $auth;


    /**
     * FacebookAuth constructor.
     * @param UserRepository $users
     * @param Socialite $socialite
     * @param Authenticatable $auth
     */
    public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }


    /**
     * @param $hasCode
     * @return mixed
     */
    public function execute($request, $listener, $provider){

        if (!$request)
            return $this->getAuthorizationFirst($provider);



        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider));

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);

    }

    private function getAuthorizationFirst($provider){

        return $this->socialite->driver($provider)->scopes(['public_profile','email'])->redirect();
    }

    private function getSocialUser($provider) {
        return $this->socialite->driver($provider)->user();
    }
}