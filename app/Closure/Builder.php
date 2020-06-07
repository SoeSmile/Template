<?php
declare(strict_types=1);

namespace App\Closure;

/**
 * Class Builder
 * @package App\Closure
 */
class Builder
{
    /**
     * @param mixed ...$data
     * @return $this
     */
    public function query(...$data): self
    {
        foreach ($data as $item) {
            if ($item instanceof \Closure) {
                $item($this);
            } else {
                echo 'STR = ' . $item . '<br>';
            }
        }

        return $this;
    }

    /**
     * @param string $str
     * @return $this
     */
    public function where(string $str): self
    {
        echo 'STR = ' . $str . '<br>';

        return $this;
    }
}