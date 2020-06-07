<?php
declare(strict_types=1);

use App\Closure\Builder;

$obj = new Builder();

$obj->query('Builder', static function ($q){
    $q->query('Run')
        ->where('Where')
        ->query('Do Do')
        ->query('Close');
});

echo '<br>';

$obj->query('Builder',
    fn($q) => $q->query('Run')
        ->where('Where')
        ->query('Do Do' , static function ($q){
            $q->query('Hello', static function ($q){
                $q->where('new Hello');
            });
        })
        ->query('Close')
);