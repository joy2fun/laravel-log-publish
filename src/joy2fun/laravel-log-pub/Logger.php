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
            'quiet' => false,
            'max_trace_length' => 1024,
        ], $config['with'] ?? []);

        $handler = new Handler(
            $this->getLevel($config['level'] ?? null),
            $with['connection'],
            $with['quiet']
        );
        $handler->setFormatter(
            new Formatter(
                $with['format'],
                $with['max_trace_length']
            )
        );
        return new MonologLogger('PUB', [$handler]);
    }

    public function getLevel($level) {
        if ($level) {
            $levelName = "Monolog\Logger::" . strtoupper($level);
            if (defined($levelName)) {
                return constant($levelName);
            }
        }

        return MonologLogger::DEBUG;
    }
}
