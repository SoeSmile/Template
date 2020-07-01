<?php
declare(strict_types=1);

namespace App\Helper;

/**
 * Class Common
 * @package App\Helper
 */
class Common
{
    /**
     * @var float
     */
    private float $time;

    /**
     * @param string $str
     * @param bool $time
     */
    public function write(string $str, bool $time = false): void
    {
        if ($time) {
            $this->start();
        }

        $mem = \memory_get_peak_usage(true) / 1024 / 1024;

        echo $str . '. Memory: ' . $mem . "\n";
    }

    /**
     * @return $this
     */
    public function start(): self
    {
        $this->time = \microtime(true);

        return $this;
    }

    /**
     * @return float
     */
    public function end(): float
    {
        $end = \microtime(true);

        return \round($end - $this->time, 2);
    }
}