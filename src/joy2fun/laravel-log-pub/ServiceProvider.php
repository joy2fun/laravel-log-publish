<?php

namespace Joy2fun\RedisPubLogger;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Joy2fun\RedisPubLogger\Commands\Subscribe;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Subscribe::class,
            ]);
        }
    }
}
