<?php

namespace IagoEffting\TwoFactorAPI\Facades;

use Illuminate\Support\Facades\Facade;

class TwoFactor extends Facade
{


    /**
     * Accessor name of Facade
     * @return string
     */
    protected static function getFacadeAccessor()
    {

         return 'TwoFactor';

    }


}