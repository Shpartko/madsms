# madsms

Hi there!
It's an implementation of test case for checking basics laravel skills.

Send sms/mms via random providers.

Madsms - One random gateway for one request
SuperMadsms - All gateways for one request

## Install:

Install Laravel

```bash
composer create-project laravel/laravel test
php artisan key:generate

```

Install this package via composer using this command:

```bash
composer require shpartko/madsms
```

That's all. The package will automatically register itself.

## Implement:

You can publish the config, lang and views files with:

```bash
php artisan vendor:publish --provider="Shpartko\Madsms\MadServiceProvider"
```

## Facade

You can register MadSMS facades in your config\app.php in aliases section:

```
    'aliases' => [
        'Madsms' => Shpartko\Madsms\Facades\Madsms::class,
        'SuperMadsms' => Shpartko\Madsms\Facades\SuperMadsms::class,
    ],
```

After that you can use short path for access to MadSMS, for example:

```php
Madsms::getGateway()->getGatewayName();
or
SuperMadsms::getRandomGateway()->getGatewayName();
```

## Usage:

For get results of working this package, please, pick one of this url:

```
http(s)://your-domain/madsms
and
http(s)://your-domain/supermadsms
```

For example: [http://localhost/madsms](http://localhost/madsms) or [http://localhost/supermadsms](http://localhost/supermadsms)

## Clear cache

```bash
php artisan package:discover
php artisan route:clear
php artisan config:clear
php artisan clear-compiled
```
