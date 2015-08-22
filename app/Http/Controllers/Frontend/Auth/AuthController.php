<?php
/**
* Author: German Mendoza
* Twitter: german0296
* Description: Controller to handle authentication frontend
*/
namespace App\Http\Controllers\Frontend\Auth;

use App\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use Mail;
use Input;
use Session;
use App\Helpers\MyFile;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $subjectVerified = "Verifica tu cuenta";
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'            => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:6|max:16',
            'password_confirmation' => 'required|min:6|max:16',
            'postal_code'           => 'required|max:5|min:5'
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
        return User::create([
            'first_name'       => $data['first_name'],
            'email'            => $data['email'],
            'postal_code'      => $data['postal_code'],
            'password'         => bcrypt($data['password']),
            'avatar_standar'   => $data['avatar_standar'],
            'avatar_thumbnail' => $data['avatar_thumbnail'],
            'verified_code'    => $data['verified_code'],
            'bidicode'         => str_random(15)
        ]);
    }

    public function getLogin(){
        return view('frontend.auth.login', ['auth' => 1, 'general' => 1, 'login' => 1]);
    }

    public function postLogin(Request $request){

        if($request->ajax()) {
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'is_active' => 1],$request->has('remember'))) {

                //case when search a barrio
                Session::forget('barrio_search');

                return response()->json([
                    'success' => [
                        'message' => 'Login User'
                    ]
                ], 200);

            }
            else{
                return response()->json([
                    'error' => [
                        'message' => 'Unauthorized'
                    ]
                ], 401);
            }
        }


        return response()->json([
            'error' => [
                'message' => 'Bad Request'
            ]
        ], 400);

    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();
        Session::forget('send_verify_manual');
        Session::forget('barrio');
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function getRegister(){
        return view('frontend.auth.register', ['auth' => 1, 'general' => 1, 'register' => 1]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {

            return response()->json([
                'error' => [
                    'message' => $validator->messages()
                ]
            ], 400);
        }

        $data=$request->all();
        $avatars = MyFile::randomAvatar();
        $data['avatar_thumbnail'] = $avatars['avatar_thumbnail'];
        $data['avatar_standar'] = $avatars['avatar_standar'];
        $data['verified_code'] = str_random(60);

        $user = $this->create($data);

        Auth::login($user);

        Mail::send('emails.verify', array('verified_code' =>$data['verified_code']), function($message) {
            $message->to(Input::get('email'))
                ->subject($this->subjectVerified);
        });

        Session::put('register',1);

        return response()->json([
            'success' => [
                'response' => $user
            ]
        ], 200);
    }

    public function getVerify($verified_code){

        if(!$verified_code)
        {
            return view('frontend.account.verify')->withErrors(array('error'=>'Codigo de Verificacion Invalido'));
        }

        $user = User::where('verified_code', '=', $verified_code)->first();

        if (!$user) {
            return view('frontend.account.verify')->withErrors(array('error'=>'Codigo de Verificacion Invalido'));
        }

        $user->is_verify = 1;
        $user->verified_code = null;
        $user->save();

        return view('frontend.account.verify');

    }

    public function getLoginWithProvider(ProviderSocialAuth $authenticateUser, Request $request, $provider = null){

        return $authenticateUser->execute($request->all(), $this, $provider);

    }

    public function userHasLoggedIn($user) {
        return redirect('/');
    }
}
