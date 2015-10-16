<?php

namespace IagoEffting\TwoFactorAPI\Middleware;

use Closure;
use IagoEffting\TwoFactorAPI\TwoFactor as TwoFactorApi;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class TwoFactorAuthenticate
 * @package IagoEffting\TwoFactorAPI\Middleware
 */
class TwoFactorAuthenticate
{

    protected $auth;
    protected $twoFactor;


    /**
     * @param JWTAuth $auth
     * @param TwoFactor $twoFactor
     */
    public function __construct(JWTAuth $auth, TwoFactorApi $twoFactor)
    {

        $this->auth      = $auth;
        $this->twoFactor = $twoFactor;

    }


      /**
       * Run the request filter.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  \Closure  $next
       *
       * @return mixed
       */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->toUser($request->input('token'));

        if ($this->twoFactor->isEnable($user) === true) {
            if ($this->twoFactor->verifyAuthenticate($user) === false) {
                $data = [
                         'Exceptions' => 'Not Validate',
                         'urlCreate'  =>
                             url("api/v1/two-factor/authenticate?token=".$request->input('token'))
                        ];

                return response()->json($data);

            }
        }

        return $next($request);

    }


}