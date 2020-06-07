<?php
declare(strict_types=1);

use App\Feed\Builder\Ebay\Ebay;
use App\Feed\MakeFile\MakeCSV;

$data =  include 'data.php';

$ebay = new Ebay($data);

var_dump($ebay->getData());