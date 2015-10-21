<?php

namespace IagoEffting\TwoFactorAPI;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{

    protected $table = 'access_user';


    public function user()
    {
        $userModel = config('twofactor.user_model');

        return $this->belongsTo($userModel);

    }


}

