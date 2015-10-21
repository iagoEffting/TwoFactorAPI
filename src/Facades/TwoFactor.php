<?php

namespace IagoEffting\TwoFactorAPI\Facades;

use Illuminate\Support\Facades\Facade;

class TwoFactor extends Facade
{


    protected static function getFacadeAccessor()
    {

         return 'TwoFactor';

    }


}