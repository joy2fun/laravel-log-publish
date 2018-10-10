<?php

namespace Joy2fun\RedisPubLogger;

use Illuminate\Support\Facades\Redis;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class Handler extends AbstractProcessingHandler
{
    private $connection;

    public function __construct($level = Logger::DEBUG, $connection) {
        $this->connection = $connection;
        parent::__construct($level, true);
    }

    protected function write(array $record)
    {
        Redis::connection($this->connection)
            ->publish("laravel-log-channel", $record['formatted']);
    }

}
