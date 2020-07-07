<?php

namespace Tests\Unit\AppexNpayApi\Exceptions;

use App\Library\Services\AppexNpayApi\Exceptions\RequestException;
use Tests\TestCase;

/**
 * Class RequestExceptionTest
 * @package Tests\Unit\AppexNpayApi\Exceptions
 */
class RequestExceptionTest extends TestCase
{
    public function test_it_is_instantiable()
    {
        $this->assertInstanceOf(RequestException::class, new RequestException());
    }
}