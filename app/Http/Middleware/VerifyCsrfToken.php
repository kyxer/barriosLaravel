<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/*'
    ];

    protected function tokensMatch($request){
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');
        //dd($token."-----".$request->session()->token());
        return $request->session()->token() == $token;
    }
}
