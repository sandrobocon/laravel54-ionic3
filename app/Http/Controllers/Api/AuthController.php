<?php

namespace CodeFlix\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    public function accessToken(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        if($token = \Auth::guard('api')->attempt($credentials)) {
            return $this->sendLoginResponse($request,$token);
        }
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        return ['token' => $token];
    }
}
