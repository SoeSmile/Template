<?php
declare(strict_types=1);
ini_set("memory_limit",'1G');

use App\Feed\Builder\Ebay\Ebay;
use App\Feed\Faker;
use App\Feed\MakeFile\MakeCSV;

$data = Faker::makeArray(20, 1000000);

$start = \microtime(true);

$ebay = new Ebay($data);
$file = new MakeCSV($ebay->getData());

$mem = \memory_get_peak_usage(true) / 1024 / 1024;
$end = \microtime(true) - $start;
echo 'Build:  time: ' . \round($end, 2) . ' mem: ' . \round($mem, 2) . "\n";

$file->make();

$mem = \memory_get_peak_usage(true) / 1024 / 1024;
$end = \microtime(true) - $start;
echo 'File:  time: ' . \round($end, 2) . ' mem: ' . \round($mem, 2) . "\n";
