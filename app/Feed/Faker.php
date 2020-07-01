<?php
declare(strict_types=1);

namespace App\Feed;

/**
 * Class Faker
 * @package App\Feed
 */
class Faker
{
    /**
     * @param int $count
     * @return array
     */
    public static function makeArray(int $count = 1): array
    {
        $array = [];

        foreach (range(1, $count) as $value) {

            $array[] = [
                'name_1' => \hash('sha256', (string)($value + 1)),
                'name_2' => \hash('sha256', (string)($value + 2)),
                'name_3' => \hash('sha256', (string)($value + 3)),
                'name_4' => \hash('sha256', (string)($value + 4)),
                'name_5' => \hash('sha256', (string)($value + 5)),
                'name_6' => \hash('sha256', (string)($value + 6)),
                'name_7' => \hash('sha256', (string)($value + 7)),
                'name_8' => \hash('sha256', (string)($value + 8)),
                'name_9' => \hash('sha256', (string)($value + 9)),
                'name_0' => \hash('sha256', (string)($value + 0)),
            ];
        }

        return $array;
    }
}