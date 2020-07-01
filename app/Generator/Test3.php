<?php
declare(strict_types=1);

namespace App\Generator;

class Test3
{
    public function index()
    {
        $data = $this->makeGenerator();

        foreach ($data as $datum) {
            echo $datum . ' ';
        }
    }

    private function makeArray()
    {
        $arr = [];

        foreach (range(0, 1000000) as $item) {
            $arr[] = $item;
        }

        return $arr;
    }

    private function makeGenerator()
    {
        foreach (range(0, 1000000) as $item) {
            yield $item;
        }
    }
}