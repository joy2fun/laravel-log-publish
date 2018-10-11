<?php

namespace Tests;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redis;
use Joy2fun\RedisPubLogger\Handler;
use Monolog\Logger as Monolog;
use PHPUnit\Framework\TestCase;

class HandlerTest extends TestCase
{
    /**
     * @expectedException Exception
     *
     * @return void
     */
    public function testThrowException()
    {
        Redis::clearResolvedInstances();
        Redis::shouldReceive('connection')->andThrow(Exception::class);
        $handler = new Handler(Monolog::DEBUG, '', $quiet = false);
        (new Monolog('__test', [$handler]))->emergency("");
    }

    /**
     * @doesNotPerformAssertions
     *
     * @return void
     */
    public function testSkipException()
    {
        Redis::clearResolvedInstances();
        Redis::shouldReceive('connection')->andThrow(Exception::class);
        $handler = new Handler(Monolog::DEBUG, '', $quiet = true);
        (new Monolog('__test', [$handler]))->emergency("");
    }

    /**
     * @expectedException InvalidArgumentException
     *
     * @return void
     */
    public function testForceThrowException()
    {
        Redis::clearResolvedInstances();
        Redis::shouldReceive('connection')->andThrow(InvalidArgumentException::class);
        $handler = new Handler(Monolog::DEBUG, '', $quiet = true);
        (new Monolog('__test', [$handler]))->emergency("");
    }
}
