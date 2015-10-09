<?php

namespace IagoEffting\TwoFactorAPI;

use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'user_secrets';

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