<?php
declare(strict_types=1);

namespace App\Generator;

use Closure;
use Generator;

class Test1
{
    public function index()
    {
        $arr = [1, 2, 3, 4, 5, 6];

        $coll = $this->collect($arr, fn($e) => $e * $e);

        foreach ($coll as $item) {
            echo $item . ' ';
        }
    }

    /**
     * @param array $array
     * @param Closure $callback
     * @return Generator
     */
    private function collect(array $array, Closure $callback): ?Generator
    {
        foreach ($array as $item) {
            yield $callback($item);
        }
    }
}