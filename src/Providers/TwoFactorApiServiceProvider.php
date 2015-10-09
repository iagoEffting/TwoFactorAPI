<?php

namespace IagoEffting\TwoFactorAPI\Providers;

use Illuminate\Support\ServiceProvider;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorApiServiceProvider extends ServiceProvider
{

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('IagoEffting\TwoFactorAPI', function($app){
      return new TwoFactorAPI;
    });
    $this->app->bind('PragmaRX\Google2FA\Contracts\Google2FA', function($app){
      return new Google2FA();
    });

    $loader = \Illuminate\Foundation\AliasLoader::getInstance();
    $loader->alias('Google2FA', 'PragmaRX\Google2FA\Vendor\Laravel\Facade');

  }

  public function boot()
  {
    $this->publishes([
      __DIR__. '/../resources/migrations/2015_09_08_000000_create_user_secrets_table.php' => base_path('database/migrations/2015_09_08_000000_create_user_secrets_table.php'),
      __DIR__. '/../resources/config/twofactor.php' => base_path('config/twofactor.php')
    ]);
  }

}