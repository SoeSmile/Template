<?php
declare(strict_types=1);

namespace App\Generator;

use Closure;
use Generator;

class Test2
{
    public function index()
    {
        $arr = [1, 2, 3, 4, 5, 6];

        foreach ($this->collect($arr) as $item){
            echo $item . ' ';
        }
    }

    private function square($val)
    {
        yield $val + $val;
    }

    private function collect(array $array)
    {
        foreach ($array as $item) {
            if($item % 2 === 0) yield from $this->square($item);
        }
    }
}