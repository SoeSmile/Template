<?php
declare(strict_types=1);

use App\Feed\Builder\Ebay\Ebay;
use App\Feed\MakeFile\MakeCSV;

$data = \App\Feed\Faker::makeArray(20, 100000);

$ebay = new Ebay($data);

var_dump($ebay->getData());