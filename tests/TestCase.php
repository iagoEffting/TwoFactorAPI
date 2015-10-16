<?php

namespace IagoEffting\TwoFactorAPITest;

/**
 * Class TestCase
 */
class TestCase extends \Illuminate\Foundation\Testing\TestCase
{

    /**
     * The base URL to use while testing the application.
     * @var string
     */
    protected $baseUrl = 'http://localhost';


    /**
     * Creates the application.
     *
     * @return mixed
     */
    public function createApplication()
    {
        $app = include __DIR__.'/../bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;

    }


}
