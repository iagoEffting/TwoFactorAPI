<?php

namespace IagoEffting\TwoFactorAPI\Traits;

trait HasTwoFactor
{

  public function secret()
  {
    $secret_model = config('twofactor.secret_model');
    return $this->hasOne($secret_model);
  }

  /**
   * Generate Key for user TwoFactor
   *
   * @return string
   */
  public function generateKey()
  {
    $google2fa = app()->make('PragmaRX\Google2FA\Contracts\Google2FA');
    $secret_length = config('twofactor.secret_length');
    $secret = $google2fa->generateSecretKey($secret_length);

    return $secret;
  }

  public function generateQRCode()
  {
    $companyName = config('twofactor.company_name');
    $google2fa = app()->make('PragmaRX\Google2FA\Contracts\Google2FA');

    $urlQr = $google2fa->getQRCodeGoogleUrl(
      $companyName,
      $this->email,
      $this->secret->key
    );

    return $urlQr;

  }

}