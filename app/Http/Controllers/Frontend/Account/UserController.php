<?php
/**
* Author: German Mendoza
* Twitter: german0296
* Description: Controller for account activity
*/
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
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Subject for verification email
     * @var string
     */
    protected $subjectVerified = "Verifica tu cuenta";

    /**
     * Function to validate register data
     * @param  array  $data
     * @return boolean
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'         => 'required|max:255',
            'last_name'          => 'max:50',
            'email'              => 'required|confirmed|email|max:255',
            'email_confirmation' => 'required',
            'postal_code'        => 'required|max:5|min:5',
            'phone'              => 'max:20',
            'address'            => 'max:200'
        ]);
    }

    public function getAvatar(){
        return view('frontend.account.avatar',['general' => 1, 'dashboardAuth' => 1]);
    }

    /**
     * Function to add avatar to user
     * @param  RequestHttp $request
     * @return array
     */
    public function postAvatar(RequestHttp $request){

        // Rules for server side validations
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

        $user->avatar_standar   = $avatars['avatar_standar'];
        $user->avatar_thumbnail = $avatars['avatar_thumbnail'];

        $user->save();

        return response()->json([
            'success' => [
                'response' => $avatars
            ]
        ], 200);
    }
    /**
     * Function to get view profile
     * @return view
     */
    public function getProfile(){
        $barrio = Barrio::where('postal_code','=',Auth::user()->postal_code)->first();
        if($barrio){
            Session::put('barrio', $barrio);
        }
        else{
            Session::forget('barrio');
        }
        $data = [];
        $data['general'] = 1;
        $data['dashboardAuth'] = 1;
        return view('frontend.account.profile', $data);
    }
    /**
     * Function to update profile
     * @param   $request
     * @return redirect
     */
    public function postProfile(RequestHttp $request){
        //Calling to validator function
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

            $user->email         =  Request::input('email');
            $user->is_verify     = 0;
            $user->verified_code = null;
            $user->provider_id   = null;
        }

        $user->first_name  = Request::input('first_name');
        $user->last_name   = Request::input('last_name');
        $user->postal_code = Request::input('postal_code');
        $user->phone       = Request::input('phone');
        $user->address     = Request::input('address');

        $user->save();

        return redirect()->back()
            ->with(['success'=>1]);

    }
    /**
     * Function to change password
     * @param  RequestHttp $request
     * @return redirect
     */
    public function postChangePassword(RequestHttp $request){
        // Rules for server side validations
        $this->validate($request, [
            'password_old'          => 'required|min:6|max:16',
            'password'              => 'required|min:6|max:16|confirmed',
            'password_confirmation' => 'required|min:6|max:16',
        ]);
        //Authenticating user with new password
        $user = Auth::user();
        if(!Auth::attempt(['email' => $user->email, 'password' => $request->input('password_old'), 'is_active' => 1]))
            return redirect()->back()->withErrors(["password" => "Contraseña invalida"]);


        $user->password = bcrypt($request->input('password'));
        $user->save();
        Auth::login($user);

        return redirect()->back()->with(["password"=>"Contraseña cambiada exitosamente" ]);

    }
    /**
     * Function to send verify email
     * @param  RequestHttp $request
     * @return  redirect
     */
    public function postVerify(RequestHttp $request){
        // Rules for server side validations
        $this->validate($request, [
            'redirect_to' => 'required'
        ]);

        $verified_code       = str_random(60);

        $user                = Auth::user();

        $user->verified_code = $verified_code;
        $user->save();

        //sending email
        Mail::send('emails.verify', array('verified_code' =>$verified_code), function($message) {
            $message->to(Auth::user()->email)
                ->subject($this->subjectVerified);
        });

        Session::put('send_verify_manual', 1);
        return redirect(Request::input('redirect_to'))->with(['send_verify_manual_check'=>1]);
    }


}
