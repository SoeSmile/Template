<?php

namespace Tests\Unit\AppexNpayApi;

use App\Library\Services\AppexNpayApi\AppexNpayApi;
use App\Library\Services\AppexNpayApi\Exceptions\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

/**
 * Class AppexNpayApiTest
 * @package Tests\Unit\AppexNpayApi
 */
class AppexNpayApiTest extends TestCase
{
    private $requestData = [
        'terminal' => 'foo',
        'login' => 'foo',
        'password' => 'foo',
        'type' => 'check'
    ];

    private $responseData = '<?xml version="1.0" encoding="windows-1251"?><response date="2019-10-18T10:14:57+03:00"
                software="NPAY 1.1016.125956"><errors><error id="0" message="OK" /></errors><body type="1"><payment
                tran="7db63554-898f-97a9-80b8-f20c747dd4c9" status="2" id="138481771" balance="0.00"
                /></body><extras><extra name="configuration" value="29FD44EE" /><extra name="configuration_dealer"
                value="7CB15FB2" /><extra name="configuration_files" value="92ADFA97" /><extra name="balance"
                value="149944.66" currency="810" /><extra name="balance_real" value="149944.66" currency="810" /><extra
                name="configuration_payee" value="20807727" /></extras></response>';

    public function test_it_is_instantiable()
    {
        $this->assertInstanceOf(AppexNpayApi::class, new AppexNpayApi(new Client()));
    }

    public function test_setUrl_url_empty()
    {
        $url = '';

        $client = new AppexNpayApi($this->getHttpResponse(200, [], $this->responseData), $url);

        $this->assertNotEmpty($client->getUrl());
    }

    public function test_setUrl_url()
    {
        $url = 'foo';

        $client = new AppexNpayApi($this->getHttpResponse(200, [], $this->responseData), $url);

        $this->assertEquals($client->getUrl(), $url);
    }

    public function test_request_status()
    {
        $this->requestData['id'] = 'abs';

        $client = new AppexNpayApi($this->getHttpResponse(200, [], $this->responseData));

        $result = $client->request($this->requestData)->status();

        $this->assertIsInt($result);
    }

    public function test_request_new()
    {
        $this->requestData['type'] = 'new';
        $this->requestData['account'] = 'foo';
        $this->requestData['amount_in'] = 100.33;
        $this->requestData['amount_out'] = 22.33;
        $this->requestData['id'] = 'foo';

        $client = new AppexNpayApi($this->getHttpResponse(200, [], $this->responseData));

        $result = $client->request($this->requestData)->status();

        $this->assertIsInt($result);
    }

    public function test_request_check()
    {
        $this->requestData['type'] = 'check';

        $client = new AppexNpayApi($this->getHttpResponse(200, [], $this->responseData));

        $result = $client->request($this->requestData)->balance();

        $this->assertIsFloat($result);
    }

    public function test_request_error_client()
    {
        $this->expectException(RequestException::class);

        $client = new AppexNpayApi($this->getHttpResponse(401, [], $this->responseData));

        $client->request($this->requestData)->status();
    }

    public function test_request_error_server()
    {
        $this->expectException(RequestException::class);

        $client = new AppexNpayApi($this->getHttpResponse(500, [], $this->responseData));

        $client->request($this->requestData)->status();
    }

    private function getHttpResponse(int $status = 200, array $headers = [], $body = null)
    {
        $mock = new MockHandler([
            new Response($status, $headers, $body)
        ]);
        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }
}