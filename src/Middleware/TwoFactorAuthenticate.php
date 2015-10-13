<?php

namespace IagoEffting\TwoFactorAPI\Middleware;

use Closure;
use IagoEffting\TwoFactorAPI\TwoFactor;
use Tymon\JWTAuth\JWTAuth;

class TwoFactorAuthenticate
{

  protected $auth;
  protected $twoFactor;

  public function __construct(JWTAuth $auth, TwoFactor $twoFactor)
  {
    $this->auth = $auth;
    $this->twoFactor = $twoFactor;
  }

  /**
   * Run the request filter.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $user = $this->auth->toUser($request->input('token'));

    // Validar TwoFactor
    var_dump($this->twoFactor->isEnable($user));
    if ($this->twoFactor->isEnable($user)) {
      if (!$this->twoFactor->verifyKey($user)) {
        $data = array(
          'ExceptionValidateTwoFactor' => 'Not Validate',
          'urlCreate' => url("api/v1/two-factor/create")
        );

        return response()->json($data);
      }
    }

    return $next($request);
  }

}