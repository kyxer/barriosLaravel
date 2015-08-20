/**
* Author: German Mendoza
* Twitter: german0296 
* Description: Controller for interection with table user.
*/

<?php

namespace App\Http\Controllers\Api\Account;

use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Dingo\Api\Exception as DingoException;
use Symfony\Component\HttpKernel\Exception as Exceptions;
use App\Helpers\MyImage;

class UserController extends Controller
{
    
    /**
     * Fuction to update profile values
     * @param  Request $request     
     * @return $user          
     */
    public function putUser(Request $request){

        // Rules for server side validations
        $rules = [
             'first_name' => ['required', 'max:255'],
             'last_name' => ['max:50'],
             'email' => ['required', 'confirmed', 'email', 'max:255'],
             'email_confirmation' => ['required'],
             'postal_code' => ['required', 'max:5', 'min:5'],
             'phone' => ['max:20'],
             'address' => ['max:200']
         ];

        $data = $request->all();

        $validator = app('validator')->make($data, $rules);

        if ($validator->fails()) {
            throw new DingoException\StoreResourceFailedException('Could not Update user', $validator->errors());
        }

        //Check if token is valid
        $user = JWTAuth::parseToken()->authenticate();

        if(!$user){
            throw new Exceptions\AccessDeniedHttpException('Invalid Credentials');
        }

        if($user->email != $request->input('email')){
            $rules = [
                'email' => ['unique:users']
            ];

            $validator = app('validator')->make($request->input('email'), $rules);

            if ($validator->fails()) {
                throw new DingoException\StoreResourceFailedException('Could not Update user', $validator->errors());
            }

            $user->email = $request->input('email');
            $user->is_verify = 0;
            $user->verified_code = null;
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->postal_code = $request->input('postal_code');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');

        $user->save();

        $token = JWTAuth::fromUser($user);
        $user = $user->toArray();
        $user['token'] = $token;

        return $user;
    }

    /**
     * Function to create other avatar for user
     * @param  Request $request
     * @return $user           
     */
    public function postAvatar(Request $request){

        //Rules for server sides validations
        $rules = [
            'avatar' => ['required']
        ];

        $data = $request->all();

        $validator = app('validator')->make($data, $rules);

        if ($validator->fails()) {
            throw new DingoException\StoreResourceFailedException('Could not Update user', $validator->errors());
        }

        //Check if token is valid
        $user = JWTAuth::parseToken()->authenticate();

        if(!$user){
            throw new Exceptions\AccessDeniedHttpException('Invalid Credentials');
        }

        $avatars = MyImage::uploadAvatarBase64();

        MyImage::deleteAvatar($user->avatar_standar);
        MyImage::deleteAvatar($user->avatar_thumbnail);

        $user->avatar_standar = $avatars['avatar_standar'];
        $user->avatar_thumbnail = $avatars['avatar_thumbnail'];

        $user->save();

        $token = JWTAuth::fromUser($user);
        $user = $user->toArray();
        $user['token'] = $token;

        return $user;
    }
}
