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
  protected $fillable = ['user_id', 'secret'];

  public function user()
  {
    $roleModel = config('defender.role_model', 'Artesaos\Defender\Role');
    $this->belongsTo('User');
  }

}