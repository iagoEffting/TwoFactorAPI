<?php


return [
  /*
   * Default Secret model used by TwoFactor.
   */
  'secret_model' => 'IagoEffting\TwoFactorAPI\Secret',

  /*
   * Default User model used by Laravel.
   */
  'user_model' => 'App\User',

  /*
   * Default Secret length used by Google TwoFactor.
   */
  'secret_length' => 32,
];