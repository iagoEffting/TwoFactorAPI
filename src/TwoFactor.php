<?php

namespace IagoEffting\TwoFactorAPI;


use Faker\Provider\DateTime;
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
   * @return bool
   */
  public function activate($user)
  {
    $secret = new Secret();
    $secret->key = TwoFactor::generateKey();

    try {
      $user->secret()->updateOrCreate(['user_id' => $user->id], $secret->toArray());
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
    if (isset($user->secret->key))
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
   * Verify if secret register is equals the secret generate of google authenticator
   *
   * @param $user
   * @param $secret
   *
   * @return bool
   */
  public function verifyKey($user, $secret)
  {

    if (!$this->isEnable($user)) {
      return false;
    }

    if(!$this->google2fa->verifyKey($user->secret->key, $secret)) {
      return false;
    }

    return true;
  }

  /**
   * Verify if user TwoFactor is authenticated
   *
   * @param $user
   * @return bool
   */
  public function verifyAuthenticate($user)
  {

    if (isset($user->access)) {
      $session_expire = config('twofactor.session_expire');

      $date = $user->access->created_at->diff(new \DateTime('NOW'))->format("%i");
      $time = (int)$date;

      if ($time >= $session_expire) {
        return false;
      }
    }


    return true;
  }

}