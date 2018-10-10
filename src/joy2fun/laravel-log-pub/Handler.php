<?php

namespace Joy2fun\RedisPubLogger;

use Illuminate\Support\Facades\Redis;
use Monolog\Handler\AbstractProcessingHandler;

class Handler extends AbstractProcessingHandler
{

    protected function write(array $record)
    {
        Redis::publish("laravel-log-channel", $record['formatted']);
    }

}
