# TwoFactorAPI
Two Factor API is a library to improve security authentication APIs. We use the system OTP (one-time password) a password that expires after some time. This implementation uses Google Autenticator to generate passwords in your mobile application.

How does it work: https://www.google.com/landing/2step/#tab=how-it-works

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
Add Service Provider and Facade to your `config/app.php`
````
IagoEffting\TwoFactorAPI\Providers\TwoFactorApiServiceProvider::class
...
'TwoFactor'  => \IagoEffting\TwoFactorAPI\Facades\TwoFactor::class
```


### 3. Middleware
Add middleware to your `app\Http\kernel.php` in variable `$routeMiddleware`
``
// Access using TwoFactor
'needTwoFactor' => \IagoEffting\TwoFactorAPI\Middleware\TwoFactorAuthenticate::class,
```

### 4. User Class
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

### 5. Publishing configuration file and migrations
Publish the configs and migrates
````
php artisan vendor:publish
```

Run migrate
````
php artisan migrate
```

## Usage
### Facade
Generate secret key
```
TwoFactor::generateKey();
#=> 53TNJZF7GYDKJ2EEOWWZM7KFRMJJMJB5
```

Generate QR Code for synchronize in your Google Authentica
```
TwoFactor::generateQrCode(['mail' => 'iago.effting@gmail.com', 'key' => '53TNJZF7GYDKJ2EEOWWZM7KFRMJJMJB5'])
#=> https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2FiNeural%3Aiago2222marina%40gmail.com%3Fsecret%3D53TNJZF7GYDKJ2EEOWWZM7KFRMJJMJB5%26issuer%3DiNeural
```

Attach in a User

```
$secret = new Secret();
$secret->key = TwoFactor::generateKey();

$user = User::find(1);
$user->secret()->save($secret);
```






