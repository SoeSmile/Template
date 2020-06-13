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
     * @param int $length
     * @param int $count
     * @return array
     */
    public static function makeArray(int $length = 1, int $count = 1): array
    {
        $array = [];
        $data = [];

        foreach (range(1, $length) as $item) {

            $data['name'] = 'name';
            $data['price'] = $item;
            $data['count'] = $item;
            $data['brand'] = 'brand';
            $data['desc'] = $item;
            $data['path'] = $item;
            $data['test_' . $item] = $item;
        }

        foreach (range(1, $count) as $value) {

            $array[$value] = $data;
        }

        return $array;
    }
}