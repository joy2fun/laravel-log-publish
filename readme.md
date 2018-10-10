
# Logging to Redis channel for Laravel


## Installation

```sh
composer require joy2fun/laravel-log-pub
```

## Configuration

Add a custom logger channel to `config/logging.php` :

```
'pub' => [
    'driver' => 'custom',
    'via' => \Joy2fun\RedisPubLogger\Logger::class
],
```

Logging to configured channel:

```php
Log::channel("pub")->debug("dummy");
```

## Subscribe Redis channel

```sh
php artisan redis:subscribe
```
