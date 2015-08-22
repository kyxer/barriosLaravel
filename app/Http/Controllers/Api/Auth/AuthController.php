<?php
/**
* Author: German Mendoza
* Twitter: german0296
* Description: Controller for authenticate api, creating token
*/

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;

use JWTAuth;
use Mockery\CountValidator\Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception as Exceptions;
use Dingo\Api\Exception as DingoException;

use Illuminate\Support\Facades\Input;
use Mail;
use App\Repositories\UserRepository;
use App\User;
use App\Barrio;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class AuthController extends Controller
{


    private $user;
    /**
     * Subject for email recover
     * @var string
     */
    protected $subjectRecover = "Recuperar Contraseña";
    /**
     * Subeject for email verified
     * @var string
     */
    protected $subjectVerified = "Verifica tu cuenta";


    /**
     * Constructor
     * @param UserRepository $user object to check if user exist
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    /**
     * Function to login user
     * @param  Request $request
     * @return $user
     */
    public function postLogin(Request $request){

        // Rules for server side validations
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
        //chacking credentials for user
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
        $user['token'] = $token['token'];

        $user['barrio'] = '';
        $barrio = Barrio::where('postal_code','=',$user['postal_code'])->first();
        if($barrio) {
            $user['barrio'] = $barrio->name;
        }

        return $user;
    }

    /**
     * Function to register user in system
     * @param  Request $request
     * @return $user
     */
    public function postRegister(Request $request){

        // Rules for server side validations
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
        $data['verified_code'] = str_random(60);
        $user = $this->user->create($data);
        //send verify mail
        Mail::send('emails.verify', array('verified_code' =>$data['verified_code']), function($message) {
            $message->to(Input::get('email'))
                ->subject($this->subjectVerified);
        });
        //create token for user
        $token = JWTAuth::fromUser($user);
        $user = $user->toArray();
        $user['token'] = $token;

        $user['barrio'] = '';
        $barrio = Barrio::where('postal_code','=',$user['postal_code'])->first();
        if($barrio) {
            $user['barrio'] = $barrio->name;
        }

        return $user;
    }
    /**
     * Function to register or authenticated with facebook
     * @param  Request $request
     * @return $user
     */
    public function postProvider(Request $request){
        // Rules for server side validations
        $rules = [
            'email' => ['required', 'email'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'provider_id' => ['required'],
            'avatar_standar' => ['required'],
            'avatar_thumbnail' => ['required']
        ];

        $data = $request->all();

        $validator = app('validator')->make($data, $rules);

        if ($validator->fails()) {
            throw new DingoException\StoreResourceFailedException('Error data', $validator->errors());
        }

        //Check user in database
        $user = $this->user->findByUserNameOrCreateFromApp($data);
        //Create token
        $token = JWTAuth::fromUser($user);
        $user = $user->toArray();
        $user['token'] = $token;

        $user['barrio'] = '';
        if(isset($user['postal_code'])) {
            $barrio = Barrio::where('postal_code', '=', $user['postal_code'])->first();
            if ($barrio) {
                $user['barrio'] = $barrio->name;
            }
        }

        return $user;

    }
    /**
     * Function to send a recover email for password reset
     * @param  Request $request
     * @return string | Exception
     */
    public function postRecover(Request $request){
        // Rules for server side validations
        $rules = [
            'email' => ['required', 'email'],
        ];

        $data = $request->all();

        $validator = app('validator')->make($data, $rules);

        if ($validator->fails()) {
            throw new DingoException\StoreResourceFailedException('Could not Create user.', $validator->errors());
        }

        //Sending email
        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->subjectRecover);
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return "Mail Sent";

            case Password::INVALID_USER:
                throw new Exceptions\NotFoundHttpException('Not Found Email');
        }
    }
}
