<?php

namespace Joy2fun\RedisPubLogger;

use Monolog\Formatter\LineFormatter;

class Formatter extends LineFormatter
{
    private $maxTraceLength;

    public function __construct($format = null, $maxTraceLength = 1024)
    {
        parent::__construct($format = null, null, true, true);

        if ($this->maxTraceLength = $maxTraceLength) {
            $this->includeStacktraces();
        }
    }

    protected function normalizeException($e)
    {
        // TODO 2.0 only check for Throwable
        if (!$e instanceof \Exception && !$e instanceof \Throwable) {
            throw new \InvalidArgumentException('Exception/Throwable expected, got '.gettype($e).' / '.get_class($e));
        }

        $previousText = '';
        if ($previous = $e->getPrevious()) {
            do {
                $previousText .= ', '.get_class($previous).'(code: '.$previous->getCode().'): '.$previous->getMessage().' at '.$previous->getFile().':'.$previous->getLine();
            } while ($previous = $previous->getPrevious());
        }

        $str = '[object] ('.get_class($e).'(code: '.$e->getCode().'): '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine().$previousText.')';
        if ($this->includeStacktraces) {
            $str .= "\n[stacktrace]\n". substr($e->getTraceAsString(), 0, $this->maxTraceLength)."\n";
        }

        return $str;
    }

    public function stringify($data) {
        if (null === $data || is_bool($data)) {
            return var_export($data, true);
        }

        if (is_scalar($data)) {
            return (string) $data;
        }

        return var_export($data, true);
    }
}