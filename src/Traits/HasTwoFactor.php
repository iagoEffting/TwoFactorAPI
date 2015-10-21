<?php

namespace IagoEffting\TwoFactorAPI\Traits;

trait HasTwoFactor
{


    public function secret()
    {
        $secretModel = config('twofactor.secret_model');

        return $this->hasOne($secretModel);

    }


    public function access()
    {
        $accessModel = config('twofactor.access_model');

        return $this->hasOne($accessModel);

    }


}