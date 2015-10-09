<?php

namespace IagoEffting\TwoFactorAPI\Traits;

trait HasTwoFactor
{

  public function secret()
  {
    $secret_model = config('twofactor.secret_model');
    return $this->hasOne($secret_model);
  }

}