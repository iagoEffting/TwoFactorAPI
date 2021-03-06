<?php

namespace IagoEffting\TwoFactorTestAPI;

use IagoEffting\TwoFactorTestAPI\TestCase as TestCaseA;

class GenerationTest extends TestCaseA
{

    protected $twoFactor;
    protected $data = [];


    public function setUp()
    {
        parent::setUp();

        $faker           = \Faker\Factory::create();
        $this->twoFactor = new \IagoEffting\TwoFactorAPI\TwoFactor();
        $email           = $faker->email;

        $this->data = [
                       'mail' => $email,
                       'key'  => strtoupper(str_random(32)),
                      ];

    }


    /**
     * @covers TwoFactor::generateKey
     */
    public function testGenerateKeyIsNotEmpty()
    {
        $this->assertNotEmpty($this->twoFactor->generateKey());

    }


    /**
     * @covers TwoFactor::generateKey
     */
    public function testKeyHaveNumberOfStrengthSecret()
    {
        $numberOfChars  = strlen($this->twoFactor->generateKey());
        $lengthOfSecret = 32;
        $this->assertEquals($lengthOfSecret, $numberOfChars);

    }


    /**
     * @covers TwoFactor::generateQrCode
     */
    public function testGenerateQrCodeIsNotNull()
    {
        $this->assertNotEmpty($this->twoFactor->generateQrCode($this->data));

    }


    /**
     * @covers TwoFactor::generateQrCode
     */
    public function testGenerateUrlQrCodeIsNotEmpty()
    {
        $company   = config('twofactor.company_name');
        $mail      = urlencode($this->data['mail']);
        $urlQrCode = "https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2F{$company}%3A{$mail}%3Fsecret%3D{$this->data['key']}%26issuer%3D$company";

        $this->assertContains(
            $this->twoFactor->generateQrCode($this->data),
            $urlQrCode
        );
    }


    public function tearDown()
    {
        parent::tearDown();

        unset($this->data);
        unset($this->twoFactor);

    }


}