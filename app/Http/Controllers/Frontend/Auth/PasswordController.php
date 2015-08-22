<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use Auth;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class PasswordController extends Controller
{

    protected $subject = "Recuperar Contraseña";


    public function __construct()
    {

    }

    public function getRecover(){
        return view('frontend.auth.recover', ['auth' => 1, 'general' => 1]);
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->subject);
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json([
                    'success' => [
                        'message' => 'Email sent'
                    ]
                ], 200);

            case Password::INVALID_USER:
                return response()->json([
                    'error' => [
                        'message' => trans($response)
                    ]
                ], 404);
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null, Request $request)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('frontend.forms.reset')->with('token', $token);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token'    => 'required',
            'password' => 'required|confirmed|min:6|max:16'
        ]);

        $credentials = $request->only(
            'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect()->back()->with('successReset',[1]);

            default:
                return redirect()->back()
                    ->withErrors(['token' => trans($response)]);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);

        $user->save();

        Auth::login($user);
    }
}
