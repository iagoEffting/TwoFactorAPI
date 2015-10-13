<?php

namespace IagoEffting\TwoFactorAPI;


use Mockery\CountValidator\Exception;

class TwoFactor
{

  protected $google2fa;

  public function __construct()
  {
    $this->google2fa = app()->make('PragmaRX\Google2FA\Contracts\Google2FA');
  }

  /**
   * Generate a key code of user for google authenticate
   */
  public function generateKey()
  {
    $secret_length = config('twofactor.secret_length');
    $secret = $this->google2fa->generateSecretKey($secret_length);

    return $secret;
  }

  /**
   * Activate TwoFactor.
   * If not enabled, it will not need to login
   *
   * @param $user
   */
  public function activate($user)
  {
    $secret = new Secret();
    $secret->key = TwoFactor::generateKey();

    try {
      $user->secret()->save($secret);
    } catch (Exception $e) {
      $error = [
        'error' => $e->getMessage()
      ];

      return $error;
    }
    
    return $user;
  }

  /**
   * Verify if TwoFactor is enable for this $user
   *
   * @param $user
   * @return bool
   */
  public function isEnable($user)
  {
    if (isset($user->secret()->key))
      return true;
    return false;
  }

  /**
   * Generate a URL of qrCode()
   *
   * @param array $data
   */
  public function generateQrCode(array $data)
  {
    $companyName = config('twofactor.company_name');

    $urlQr = $this->google2fa->getQRCodeGoogleUrl(
      $companyName,
      $data['mail'],
      $data['key']
    );

    return $urlQr;
  }

  /**
   * Verify if user Two Factor is authenticated
   *
   * @param $user
   * @return bool
   */
  public function verifyKey($user, $secret)
  {

    if (!$this->isEnable($user)) {
      return false;
    }

    $valid = $this->google2fa->verifyKey($user->secret()->key, $secret);
    dd($valid);

    return true;
  }

}