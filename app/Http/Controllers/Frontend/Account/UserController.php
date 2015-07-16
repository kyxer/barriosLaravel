<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Helpers\MyImage;
use Illuminate\Http\Request as RequestHttp;
use Request;
use App\Barrio;
use Auth;
use Validator;
use Mail;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $subjectVerified = "Verifica tu cuenta";

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' =>'max:50',
            'email' => 'required|confirmed|email|max:255',
            'email_confirmation' => 'required',
            'postal_code' => 'required|max:5|min:5',
            'phone' => 'max:20',
            'address' => 'max:200'
        ]);
    }

    //
    public function postAvatar(RequestHttp $request){

        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,gif'
        ]);

        $user = User::where('id','=', Auth::user()->id)->first();

        if(!$user)
        {
            return response()->json([
                'error' => [
                    'message' => 'User Not Found'
                ]
            ], 404);
        }

        $avatars = MyImage::uploadAvatar();

        MyImage::deleteAvatar($user->avatar_standar);
        MyImage::deleteAvatar($user->avatar_thumbnail);

        $user->avatar_standar = $avatars['avatar_standar'];
        $user->avatar_thumbnail = $avatars['avatar_thumbnail'];

        $user->save();

        return response()->json([
            'success' => [
                'response' => $avatars
            ]
        ], 200);
    }

    public function getProfile(){
        $barrio = Barrio::where('postal_code','=',Auth::user()->postal_code)->first();
        if($barrio){
            Session::put('barrio', $barrio);
        }else{
            Session::forget('barrio');
        }

        return view('frontend.account.profile');
    }

    public function postProfile(RequestHttp $request){

        $validator = $this->validator(Request::all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->messages());
        }

        $user = Auth::user();

        if($user->email != Request::input('email')){

            $this->validate($request, [
                'email' => 'unique:users'
            ]);

            $user->email =  Request::input('email');
            $user->is_verify = 0;
            $user->verified_code = null;
        }

        $user->first_name = Request::input('first_name');
        $user->last_name = Request::input('last_name');
        $user->postal_code = Request::input('postal_code');
        $user->phone = Request::input('phone');
        $user->address = Request::input('address');

        $user->save();

        return redirect()->back()
            ->with(['success'=>1]);

    }


    public function postVerify(RequestHttp $request){

        $this->validate($request, [
            'redirect_to' => 'required'
        ]);

        $verified_code = str_random(60);

        $user = Auth::user();

        $user->verified_code = $verified_code;
        $user->save();


        Mail::send('emails.verify', array('verified_code' =>$verified_code), function($message) {
            $message->to(Auth::user()->email)
                ->subject($this->subjectVerified);
        });

        Session::put('send_verify_manual', 1);

        return redirect(Request::input('redirect_to'))->with(['send_verify_manual_check'=>1]);

    }


}
