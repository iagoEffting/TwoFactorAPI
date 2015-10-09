<?php

namespace IagoEffting\TwoFactorAPI;


class TwoFactor
{

  /**
   * Generate a key code of user for google authenticate
   */
  public function generateKey()
  {
    $secret_length = config('twofactor.secret_length');
    $google2fa = app()->make('PragmaRX\Google2FA\Contracts\Google2FA');
    $secret = $google2fa->generateSecretKey($secret_length);

    return $secret;
  }

  /**
   * Generate a URL of qrCode()
   *
   * @param array $data
   */
  public function generateQrCode(array $data)
  {
    $companyName = config('twofactor.company_name');
    $google2fa   = app()->make('PragmaRX\Google2FA\Contracts\Google2FA');

    $urlQr = $google2fa->getQRCodeGoogleUrl(
      $companyName,
      $data['mail'],
      $data['key']
    );

    return $urlQr;
  }

}