<?php

/**
 * Created by PhpStorm.
 * User: German
 * Date: 16/07/2015
 * Time: 11:27 AM
 */
namespace App\Repositories;

use App\Helpers\MyImage;
use App\User;

class UserRepository
{
    public function findByUserNameOrCreate($userData) {
        $user = User::where('email', '=', $userData->email)
            ->orWhere('provider_id','=',$userData->id)
            ->first();
        if(!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'first_name' => $userData->user['first_name'],
                'last_name' => $userData->user['last_name'],
                'email' => $userData->email,
                'avatar_standar' => $userData->avatar_original,
                'avatar_thumbnail' => $userData->avatar,
                'is_verify'=>1,
                'is_active' => 1,
            ]);
        }
        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user) {

        $socialData = [
            'provider_id'=> $userData->id,
            'avatar_standar' => $userData->avatar_original,
            'avatar_thumbnail' => $userData->avatar,
            'email' => $userData->email,
            'first_name' => $userData->user['first_name'],
            'last_name' => $userData->user['last_name']
        ];
        $dbData = [
            'provider_id' => $user->provider_id,
            'avatar_standar' => $user->avatar_standar,
            'avatar_thumbnail' => $user->avatar_thumbnail,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name
        ];

        if (!empty(array_diff($socialData, $dbData))) {

            MyImage::deleteAvatar($user->avatar_standar);
            MyImage::deleteAvatar($user->avatar_thumbnail);

            $user->avatar_standar = $userData->avatar_original;
            $user->avatar_thumbnail = $userData->avatar;

            $user->email = $userData->email;
            $user->first_name = $userData->user['first_name'];
            $user->last_name = $userData->user['last_name'];
            $user->is_verify=1;
            $user->verified_code=null;
            $user->provider_id = $userData->id;
            $user->save();
        }
    }
}