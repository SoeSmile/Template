<?php

namespace Tests\Unit\AppexNpayApi\Data;

use App\Library\Services\AppexNpayApi\Data\Data;
use Tests\TestCase;

/**
 * Class DataTest
 * @package Tests\Unit\AppexNpayApi\Data
 */
class DataTest extends TestCase
{
    public function test_it_is_instantiable()
    {
        $this->assertInstanceOf(Data::class, new Data());
    }
}