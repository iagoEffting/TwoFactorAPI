# TwoFactorAPI
Two Factor API is a library to improve security authentication APIs. We use the system OTP (one-time password) a password that expires after some time. This implementation uses Google Autenticator to generate passwords in your mobile application.

## Requirements
- PHP 5.4+

## Compatibility
- Laravel 5.1+

## Installing
### 1. Dependency
````
composer require iago-effting/two-factor-api
```
or manually
````
{
    "require": {
        "iago-effting/two-factor-api": "dev-master"
    }
}
```

### 2. Provider
Add Service Provider to your `config/app.php`
````
IagoEffting\TwoFactorAPI\Providers\TwoFactorApiServiceProvider::class
```
### 3. User Class
On your User class, add the trait IagoEffting\TwoFactorAPI\Traits\HasTwoFacto to enable the creation of secret key:

````
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Artesaos\Defender\Traits\HasDefender;
use IagoEffting\TwoFactorAPI\Traits\HasTwoFactor;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

  use Authenticatable, CanResetPassword, HasTwoFactor;
...
```

### 4. Publishing configuration file and migrations
Publish the configs and migrates
````
php artisan vendor:publish
```

Run migrate
````
php artisan migrate
```






