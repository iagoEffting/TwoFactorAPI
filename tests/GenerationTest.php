<?php

class GenerationTest extends TestCase
{

  protected $twoFactor;
  protected $data = [];

  public function setUp()
  {
    parent::setUp();

    $faker = Faker\Factory::create();
    $this->twoFactor = new \IagoEffting\TwoFactorAPI\TwoFactor();
    app()->instance('TwoFactor', $this->twoFactor);

    // Data for test
    $email = $faker->email;
    $this->data = [
      'mail' => $email,
      'key' => strtoupper(str_random(32))
    ];

  }

  function testGenerateKeyIsNotEmpty()
  {
    $this->assertNotEmpty(TwoFactor::generateKey());
  }

  public function testKeyHaveNumberOfStrengthSecret()
  {
    $numberOfChars = strlen(TwoFactor::generateKey());
    $lengthOfSecret = 32;
    $this->assertEquals($lengthOfSecret, $numberOfChars);
  }

  function testGenerateQrCodeIsNotNull()
  {
    $this->assertNotEmpty(TwoFactor::generateQrCode($this->data));
  }

  function testGenerateUrlQrCodeIsNotEmpty()
  {
    $company = config('twofactor.company_name');
    $mail = urlencode($this->data['mail']);
    $urlQrCode = "https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2F{$company}%3A{$mail}%3Fsecret%3D{$this->data['key']}%26issuer%3D$company";

    $this->assertContains(TwoFactor::generateQrCode($this->data), $urlQrCode);
  }

  public function tearDown()
  {
    parent::tearDown();

    unset($this->data);
    unset($this->twoFactor);
  }


}