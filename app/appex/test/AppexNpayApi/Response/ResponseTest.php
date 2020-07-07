<?php

namespace Tests\Unit\AppexNpayApi\Response;

use App\Library\Services\AppexNpayApi\Response\Response;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    private $xml = '<?xml version="1.0" encoding="windows-1251"?><response date="2019-10-18T10:14:57+03:00"
                software="NPAY 1.1016.125956"><errors><error id="1" message="OK" /></errors><body type="1"><payment
                tran="7db63554-898f-97a9-80b8-f20c747dd4c9" status="2" id="138481771" balance="0.00"
                /></body><extras><extra name="configuration" value="29FD44EE" /><extra name="configuration_dealer"
                value="7CB15FB2" /><extra name="configuration_files" value="92ADFA97" /><extra name="balance"
                value="149944.66" currency="810" /><extra name="balance_real" value="149944.66" currency="810" /><extra
                name="configuration_payee" value="20807727" /></extras></response>';

    private $response;

    public function setUp(): void
    {
        parent::setUp();

        $this->response = new Response($this->xml);
    }

    public function test_it_is_instantiable()
    {
        $this->assertInstanceOf(Response::class, new Response($this->xml));
    }

    public function test_error()
    {
        $this->assertIsInt($this->response->error());
    }

    public function test_status()
    {
        $this->assertIsInt($this->response->status());
    }

    public function test_balance()
    {
        $this->assertIsFloat($this->response->balance());
    }

    public function test_id()
    {
        $this->assertIsString($this->response->id());
    }

    public function test_raw()
    {
        $this->assertIsArray($this->response->raw());
    }

    public function test_all()
    {
        $array = $this->response->all();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('error', $array);
        $this->assertArrayHasKey('status', $array);
        $this->assertArrayHasKey('balance', $array);
        $this->assertArrayHasKey('id', $array);
    }
}