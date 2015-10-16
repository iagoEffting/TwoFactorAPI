<?php

namespace IagoEffting\TwoFactorAPI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class TwoFactor
 * @package IagoEffting\TwoFactorAPI\Facades
 */
class TwoFactor extends Facade
{


    /**
     * Accessor of Facade
     * @return string
     */
    protected static function getFacadeAccessor()
    {

         return 'TwoFactor';

    }


}