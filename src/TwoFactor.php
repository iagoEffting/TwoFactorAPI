<?php

namespace IagoEffting\TwoFactorAPI;

use Mockery\CountValidator\Exception;

class TwoFactor
{

    /**
     * PragmaRX\Google2FA\Contracts\Google2FA
     * @var mixed
     */
    protected $google2fa;


    public function __construct()
    {
        $this->google2fa = app()->make('PragmaRX\Google2FA\Contracts\Google2FA');

    }


    /**
     * Generate a key code of user for google authenticate
     * @return string
     */
    public function generateKey()
    {
        $secretLength = config('twofactor.secret_length');

        $secret = $this->google2fa->generateSecretKey($secretLength);

        return $secret;

    }


    /**
     * Activate TwoFactor.
     * If not enabled, it will not need to login
     */
    public function activate($user)
    {
        $secret = new Secret();

        $secret->key = $this->generateKey();

        try {
            $user->secret()->updateOrCreate(
                ['user_id' => $user->id],
                $secret->toArray()
            );
        } catch (Exception $e) {
            $error = ['error' => $e->getMessage()];
            return $error;
        }

        return $user;

    }


    public function isEnable($user)
    {
        if ($user->secret->key === true) {
            return true;
        }

        return false;

    }


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
     * Verify if secret register is equals the secret
     * generate of google authenticator
     */
    public function verifyKey($user, $secret)
    {

        if ($this->isEnable($user) === false) {
            return false;
        }

        if ($this->google2fa->verifyKey($user->secret->key, $secret) === false) {
            return false;
        }

        return true;
    }


    public function verifyAuthenticate($user)
    {

        if ($user->access === true) {
            $sessionExpire = config('twofactor.session_expire');

            $dateNow = new \DateTime('NOW');

            $time = (int) $user->access->created_at->diff($dateNow)->format("%i");

            if ($time <= $sessionExpire) {
                return true;
            }
        }

        return false;

    }


}
