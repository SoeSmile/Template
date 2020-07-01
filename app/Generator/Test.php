<?php
declare(strict_types=1);

namespace App\Generator;

use Generator;

/**
 * Class Test
 * @package App\Generator
 */
class Test
{
    /**
     * @return void
     */
    public function index(): void
    {
        foreach ($this->simple() as $value) {
            echo $value . "\n";
            if ($value > 5) {
                break;
            }
        }
    }

    /**
     * @param int $from
     * @param int $to
     * @return Generator
     */
    private function simple($from = 0, $to = 100): ?Generator
    {
        for ($i = $from; $i < $to; $i++) {
            echo 'значение =' . $i . "\n";
            yield $i;
        }
    }
}