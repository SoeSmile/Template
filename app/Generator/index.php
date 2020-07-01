<?php
declare(strict_types=1);

$common = new \App\Helper\Common();

$test = new \App\Generator\Test();
$test2 = new \App\Generator\Test2();
$test3 = new \App\Generator\Test3();

$common->start()->write('Start');

$test3->index();

$common->write('Finish : ' . $common->end());