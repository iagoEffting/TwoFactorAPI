<?php

namespace IagoEffting\TwoFactorAPI\Middleware;

use Closure;
use IagoEffting\TwoFactorAPI\TwoFactor as TwoFactorApi;
use Tymon\JWTAuth\JWTAuth;

class TwoFactorAuthenticate
{

    protected $auth;
    protected $twoFactor;


    public function __construct(JWTAuth $auth, TwoFactorApi $twoFactor)
    {

        $this->auth      = $auth;
        $this->twoFactor = $twoFactor;

    }


    public function handle($request, Closure $next)
    {
        $user = $this->auth->toUser($request->input('token'));

        if ($this->twoFactor->isEnable($user) === false) {
            return $next($request);
        }

        if ($this->twoFactor->verifyAuthenticate($user) === false) {
            $token = $request->input('token');
            $data  = [
                      'Exceptions' => 'Not Validate',
                      'urlCreate'  => url(
                          "api/v1/two-factor/authenticate?token=".$token
                      ),
                     ];

            return response()->json($data);
        }

        return $next($request);

    }


}