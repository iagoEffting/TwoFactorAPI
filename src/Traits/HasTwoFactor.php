<?php

namespace IagoEffting\TwoFactorAPI\Traits;

/**
 * Class HasTwoFactor
 * @package IagoEffting\TwoFactorAPI\Traits
 */
trait HasTwoFactor
{


    /**
     * Relation with secret
     * @return mixed
     */
    public function secret()
    {
        $secretModel = config('twofactor.secret_model');

        return $this->hasOne($secretModel);

    }


    /**
     * Relation with access
     * @return mixed
     */
    public function access()
    {
        $accessModel = config('twofactor.access_model');

        return $this->hasOne($accessModel);

    }


}