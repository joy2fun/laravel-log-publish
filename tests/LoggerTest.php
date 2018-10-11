<?php

namespace Tests;

use Joy2fun\RedisPubLogger\Logger;
use Monolog\Logger as Monolog;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetLevel()
    {
        $logger = new Logger;
        $this->assertEquals($logger->getLevel('debug'), Monolog::DEBUG);
        $this->assertEquals($logger->getLevel('error'), Monolog::ERROR);
        $this->assertEquals($logger->getLevel('unknown'), Monolog::DEBUG);
        $this->assertEquals($logger->getLevel(null), Monolog::DEBUG);
    }

}
