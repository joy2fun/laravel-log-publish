<?php

namespace Joy2fun\RedisPubLogger;

use Exception;
use Illuminate\Support\Facades\Redis;
use InvalidArgumentException;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class Handler extends AbstractProcessingHandler
{
    private $skip = false;
    private $quiet = false;
    private $connection = null;

    public function __construct($level = Logger::DEBUG, $connection = 'default', $quiet = false) {
        $this->connection = $connection;
        $this->quiet = $quiet;
        parent::__construct($level, true);
    }

    protected function write(array $record)
    {
        if ($this->skip) {
            return ;
        }

        try {
            Redis::connection($this->connection)
                ->publish("laravel-log-channel", $record['formatted']);
        } catch (InvalidArgumentException $e) {
            throw $e;
        } catch (Exception $e) {
            if ($this->quiet) {
                $this->skip = true;
            } else {
                throw $e;
            }
        }
    }
}
