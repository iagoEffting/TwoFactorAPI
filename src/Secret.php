<?php

namespace IagoEffting\TwoFactorAPI;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Secret
 * @package IagoEffting\TwoFactorAPI
 */
class Secret extends Model
{

      /**
       * The database table used by the model.
       *
       * @var string
       */
    protected $table = 'secret_user';

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
    protected $fillable = ['key'];


    /**
     * User related
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        $userModel = config('twofactor.user_model');

        return $this->belongsTo($userModel);

    }


}