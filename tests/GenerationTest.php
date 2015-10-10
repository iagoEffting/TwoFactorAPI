<?php

class GenerationTest extends TestCase
{

  protected $twoFactor;

  function testGenerateKeyIsNotEmpty()
  {
    $this->twoFactor = new \IagoEffting\TwoFactorAPI\TwoFactor();
    app()->instance('TwoFactor', $this->twoFactor);

    $this->assertNotEmpty(TwoFactor::generateKey());
  }

  public function testKeyHaveNumberOfStrengthSecret()
  {
    $this->twoFactor = new \IagoEffting\TwoFactorAPI\TwoFactor();
    app()->instance('TwoFactor', $this->twoFactor);

    $numberOfChars = strlen(TwoFactor::generateKey());

    $this->assertEquals(32, $numberOfChars);
  }

  function testGenerateQrCodeIsNotNull()
  {
    $this->twoFactor = new \IagoEffting\TwoFactorAPI\TwoFactor();
    app()->instance('TwoFactor', $this->twoFactor);
    $faker = Faker\Factory::create();

    $key = strtoupper(str_random(32));

    $data = [
      'mail' => $faker->email,
      'key' => $key
    ];

    $this->assertNotEmpty(TwoFactor::generateQrCode($data));
  }

  function testGenerateUrlQrCodeIsNotEmpty()
  {
    $this->twoFactor = new \IagoEffting\TwoFactorAPI\TwoFactor();
    app()->instance('TwoFactor', $this->twoFactor);
    $faker = Faker\Factory::create();

    $key = strtoupper(str_random(32));

    $data = [
      'mail' => $faker->email,
      'key' => $key
    ];

    $company = config('twofactor.company_name');
    $email   = urlencode($data['mail']);
    $secret  = $data['key'];

    $urlQrCode = "https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2F{$company}%3A{$email}%3Fsecret%3D{$secret}%26issuer%3D$company";

    $this->assertContains(TwoFactor::generateQrCode($data), $urlQrCode);

   // TODO: REGEX
   // $this->assertRegExp('', TwoFactor::generateQrCode($data));
  }


}