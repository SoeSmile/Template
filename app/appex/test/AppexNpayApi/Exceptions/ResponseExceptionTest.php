<?php

namespace Tests\Unit\AppexNpayApi\Exceptions;

use App\Library\Services\AppexNpayApi\Exceptions\ResponseException;
use Tests\TestCase;

class ResponseExceptionTest extends TestCase
{
    public function test_it_is_instantiable()
    {
        $this->assertInstanceOf(ResponseException::class, new ResponseException());
    }
}