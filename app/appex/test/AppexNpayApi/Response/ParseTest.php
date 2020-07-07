<?php

namespace Tests\Unit\AppexNpayApi\Response;

use App\Library\Services\AppexNpayApi\Exceptions\ResponseException;
use App\Library\Services\AppexNpayApi\Response\Parser;
use Tests\TestCase;

/**
 * Class ParseTest
 * @package Tests\Unit\AppexNpayApi
 */
class ParseTest extends TestCase
{
    private $parser;

    public function setUp(): void
    {
        parent::setUp();

        $this->parser = new Parser();
    }

    public function test_it_is_instantiable()
    {
        $this->assertInstanceOf(Parser::class, new Parser());
    }

    public function test_parse_no_xml()
    {
        $this->expectException(ResponseException::class);

        $this->parser->parse('foo');
    }

    public function test_parse_return_array()
    {
        $xml = '<?xml version="1.0" encoding="windows-1251"?><response date="2019-10-18T10:14:57+03:00"
                software="NPAY 1.1016.125956"><errors><error id="0" message="OK" /></errors><body type="1"><payment
                tran="7db63554-898f-97a9-80b8-f20c747dd4c9" status="2" id="138481771" balance="0.00"
                /></body><extras><extra name="configuration" value="29FD44EE" /><extra name="configuration_dealer"
                value="7CB15FB2" /><extra name="configuration_files" value="92ADFA97" /><extra name="balance"
                value="149944.66" currency="810" /><extra name="balance_real" value="149944.66" currency="810" /><extra
                name="configuration_payee" value="20807727" /></extras></response>';

        $this->assertIsArray($this->parser->parse($xml));
    }
}