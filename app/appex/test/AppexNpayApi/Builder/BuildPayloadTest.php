<?php

namespace Tests\Unit\AppexNpayApi\Builder;

use App\Library\Services\AppexNpayApi\Builder\BuildPayload;
use Tests\TestCase;

class BuildPayloadTest extends TestCase
{
    public function test_it_is_instantiable()
    {
        $this->assertInstanceOf(
            BuildPayload::class,
            new BuildPayload([
                'terminal' => 'foo',
                'login' => 'foo',
                'password' => 'foo',
                'type' => 'status',
                'id' => 'required',
            ])
        );
    }
}