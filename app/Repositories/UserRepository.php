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
use App\Helpers\MyFile;

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
                'bidicode' => str_random(15)
            ]);
        }
        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {

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

    public function findByUserNameOrCreateFromApp(array $userData){

        $user = User::where('email', '=', $userData['email'])
            ->orWhere('provider_id','=',$userData['provider_id'])
            ->first();
        if(!$user) {
            $user = User::create([
                'provider_id' => $userData['provider_id'],
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'avatar_standar' => $userData['avatar_standar'],
                'avatar_thumbnail' => $userData['avatar_thumbnail'],
                'is_verify'=>1,
                'is_active' => 1,
                'bidicode' => str_random(15)
            ]);
        }
        $this->checkIfUserNeedsUpdatingFromApp($userData, $user);

        return $user;
    }

    public function checkIfUserNeedsUpdatingFromApp($userData, $user)
    {
        $dbData = [
            'provider_id' => $user->provider_id,
            'avatar_standar' => $user->avatar_standar,
            'avatar_thumbnail' => $user->avatar_thumbnail,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name
        ];

        if (!empty(array_diff($userData, $dbData))) {

            MyImage::deleteAvatar($user->avatar_standar);
            MyImage::deleteAvatar($user->avatar_thumbnail);

            $user->avatar_standar = $userData['avatar_standar'];
            $user->avatar_thumbnail = $userData['avatar_thumbnail'];

            $user->email = $userData['email'];
            $user->first_name = $userData['first_name'];
            $user->last_name = $userData['last_name'];
            $user->is_verify=1;
            $user->verified_code=null;
            $user->provider_id = $userData['provider_id'];
            $user->save();
        }
    }

    public function create(array $data)
    {
        $avatars = MyFile::randomAvatar();
        $data['avatar_thumbnail'] = $avatars['avatar_thumbnail'];
        $data['avatar_standar'] = $avatars['avatar_standar'];

        return User::create([
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'postal_code' => $data['postal_code'],
            'avatar_standar' => $data['avatar_standar'],
            'avatar_thumbnail' => $data['avatar_thumbnail'],
            'verified_code' => $data['verified_code'],
            'bidicode' => str_random(15),
        ]);
    }
}