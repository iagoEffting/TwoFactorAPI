<?php

namespace IagoEffting\TwoFactorAPI;

use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{


    protected $table = 'secret_user';

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
    protected $fillable = ['key'];


    public function user()
    {
        $userModel = config('twofactor.user_model');

        return $this->belongsTo($userModel);

    }


}
