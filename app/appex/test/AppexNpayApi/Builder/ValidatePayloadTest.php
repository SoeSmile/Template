<?php

namespace Tests\Unit\AppexNpayApi\Builder;

use App\Library\Services\AppexNpayApi\Builder\ValidatePayload;
use App\Library\Services\AppexNpayApi\Exceptions\ValidatorException;
use Tests\TestCase;

class ValidatePayloadTest extends TestCase
{
    use ValidatePayload;

    private $data = [
        'terminal' => 'foo',
        'login' => 'foo',
        'password' => 'foo',
        'type' => 'check'
    ];

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_validate_null_array()
    {
        $this->expectException(ValidatorException::class);

        $this->validate([]);
    }

    public function test_validate_required()
    {
        $this->assertIsArray($this->validate($this->data));
    }

    public function test_validate_required_type()
    {
        $this->data['type'] = 'foo';

        $this->expectException(ValidatorException::class);

        $this->validate($this->data);
    }

    public function test_validate_required_type_new_not_full()
    {
        $this->data['type'] = 'new';

        $this->expectException(ValidatorException::class);

        $this->validate($this->data);
    }

    public function test_validate_required_type_new_full()
    {
        $this->data['type'] = 'new';
        $this->data['account'] = 'foo';
        $this->data['amount_in'] = 100.1;
        $this->data['amount_out'] = 200;
        $this->data['id'] = 'bar';

        $this->assertIsArray($this->validate($this->data));
    }

    public function test_validate_required_type_status_full()
    {
        $this->data['type'] = 'status';
        $this->data['id'] = 'bar';

        $this->assertIsArray($this->validate($this->data));
    }

    public function test_validate_required_regex_not_number()
    {
        $this->data['type'] = 'new';
        $this->data['account'] = 'foo';
        $this->data['amount_in'] = 'bar';
        $this->data['amount_out'] = 'bar';

        $this->expectException(ValidatorException::class);

        $this->validate($this->data);
    }

    public function test_validate_required_regex_more_then_tow()
    {
        $this->data['type'] = 'new';
        $this->data['account'] = 'foo';
        $this->data['amount_in'] = 100.333;
        $this->data['amount_out'] = 200.555;

        $this->expectException(ValidatorException::class);

        $this->validate($this->data);
    }
}