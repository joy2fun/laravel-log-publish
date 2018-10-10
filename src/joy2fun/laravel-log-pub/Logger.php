<?php

namespace Joy2fun\RedisPubLogger;

use Monolog\Logger as MonologLogger;

class Logger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $with = array_merge([
            'format' => null,
            'connection' => 'default',
            'max_trace_length' => 1024,
        ], $config['with']);
        $handler = new Handler(
            $level = MonologLogger::DEBUG,
            $connection = $with['connection']
        );
        $handler->setFormatter(
            new Formatter(
                $with['format'],
                $with['max_trace_length']
            )
        );
        return new MonologLogger('PUB', [$handler]);
    }

}
