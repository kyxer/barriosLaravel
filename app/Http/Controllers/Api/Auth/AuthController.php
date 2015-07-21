<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception as Exceptions;
use Dingo\Api\Exception as DingoException;

use Illuminate\Support\Facades\Input;
use Mail;
use App\Repositories\UserRepository;
use App\User;

class AuthController extends Controller
{
    //
    /**
     * @var UserRepository
     */
    private $user;


    protected $subjectVerified = "Verifica tu cuenta";


    /**
     * AuthController constructor.
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function postLogin(Request $request){

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'max:16']
        ];

        $credentials = $request->only('email', 'password');
        $validator = app('validator')->make($credentials, $rules);

        if ($validator->fails()) {
            throw new DingoException\StoreResourceFailedException('Could not login user.', $validator->errors());
        }

        $credentials['is_active'] = 1;
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                throw new Exceptions\AccessDeniedHttpException('Invalid Credentials');
            }

        } catch (JWTException $e) {
            throw new Exceptions\InternalErrorException('Could Not Create Token');
        }

        $user = User::where('email','=',$request->input('email'))->first()->toArray();
        $token = compact('token');
        $user['token'] = $token;
        // all good so return the token
        return $user;
    }

    public function postRegister(Request $request){
        $rules = [
            'email' => ['required', 'email', 'confirmed', 'unique:users'],
            'email_confirmation' => ['required'],
            'first_name' => ['required','max:255'],
            'password' => ['required','confirmed','min:6', 'max:16'],
            'password_confirmation' => ['required','min:6','max:16'],
            'postal_code' => ['required','max:5','min:5']
        ];

        $data = $request->all();
        
        $validator = app('validator')->make($data, $rules);

        if ($validator->fails()) {
            throw new DingoException\StoreResourceFailedException('Could not Create user.', $validator->errors());
        }

        $user = $this->user->create($data);

        Mail::send('emails.verify', array('verified_code' =>$data['verified_code']), function($message) {
            $message->to(Input::get('email'))
                ->subject($this->subjectVerified);
        });

        $token = JWTAuth::fromUser($user);

        $user['token'] = $token;
        return $user;
    }
}
