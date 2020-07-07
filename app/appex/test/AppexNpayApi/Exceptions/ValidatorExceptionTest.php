<?php

namespace Tests\Unit\AppexNpayApi\Exceptions;

use App\Library\Services\AppexNpayApi\Exceptions\ValidatorException;
use Tests\TestCase;

class ValidatorExceptionTest extends TestCase
{
    public function test_it_is_instantiable()
    {
        $this->assertInstanceOf(ValidatorException::class, new ValidatorException());
    }
}