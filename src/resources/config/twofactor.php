<?php


return [
  /*
   * This name will appear on Google Autenticator app on your phone
   */
  'company_name' => 'Name of You Company',

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