
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

## More options

```php
[
    // ...
    'pub' => [
        'driver' => 'custom',
        'via' => \Joy2fun\RedisPubLogger\Logger::class,
        'with' => [
            'connection' => 'default', // redis connection
            'quiet' => false, // "true" to ignore redis connection exception. default is "false"
            'max_trace_length' => 1024, // truncated stacktrace string. set it to "0" to exclude trace from log
            'format' => "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
        ]
    ]
]
```
