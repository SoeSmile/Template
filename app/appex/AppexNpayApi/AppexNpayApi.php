<?php

namespace App\Library\Services\AppexNpayApi;

use App\Library\Services\AppexNpayApi\Builder\BuildPayload;
use App\Library\Services\AppexNpayApi\Exceptions\RequestException;
use App\Library\Services\AppexNpayApi\Response\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use function GuzzleHttp\Psr7\stream_for;

/**
 * Class AppexNpayApi
 * @package App\Library\Services\AppexNpayApi
 */
final class AppexNpayApi
{
    /**
     * url api
     */
    private $url = 'https://gate.nps-api.com/index.aspx';

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * ApiClient constructor.
     * @param ClientInterface $httpClient
     * @param string $url
     */
    public function __construct(ClientInterface $httpClient, string $url = '')
    {
        $this->httpClient = $httpClient;
        $this->setUrl($url);
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = empty($url) ? $this->url : $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param array $payload
     * @return Response
     * @throws Exceptions\ResponseException
     * @throws Exceptions\ValidatorException
     */
    public function request(array $payload): Response
    {
        return $this->send('POST', ...\func_get_args());
    }

    /**
     * @param string $method
     * @param array $payload
     * @param bool $debug
     * @return Response
     * @throws Exceptions\ResponseException
     * @throws Exceptions\ValidatorException
     */
    private function send(string $method, array $payload, bool $debug = false): Response
    {
        try {
            $response = $this->httpClient->send($this->buildHttpRequest($method, $payload), [
                'verify' => false,
                'debug' => $debug
            ]);

            return new Response($response->getBody()->getContents());

        } catch (ClientException $e) {
            throw new RequestException($e);
        } catch (ServerException $e) {
            throw new RequestException($e);
        } catch (GuzzleException $e) {
            throw new RequestException($e->getMessage());
        }
    }

    /**
     * @param string $method
     * @param array $payload
     * @return RequestInterface
     * @throws Exceptions\ValidatorException
     */
    private function buildHttpRequest(string $method, array $payload): RequestInterface
    {
        $request = new Request($method, $this->url, ['Content-Type' => 'text/xml; windows-1251']);

        $build = new BuildPayload($payload);

        return $request->withBody(stream_for($build->payload()));
    }
}