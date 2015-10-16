<?php

namespace IagoEffting\TwoFactorAPI;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Access
 * @package IagoEffting\TwoFactorAPI
 */
class Access extends Model
{

    protected $table = 'access_user';

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
