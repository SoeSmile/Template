<?php
declare(strict_types=1);

namespace App\Closure;

class Builder
{
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

    public function where(string $str): self
    {
        echo 'STR = ' . $str . '<br>';

        return $this;
    }
}