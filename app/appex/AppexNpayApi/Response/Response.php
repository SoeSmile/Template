<?php

namespace App\Library\Services\AppexNpayApi\Response;

use App\Library\Services\AppexNpayApi\Data\Data;
use App\Library\Services\AppexNpayApi\Exceptions\ResponseException;
use Illuminate\Support\Arr;

/**
 * Class Response
 * @package App\Library\Services\AppexNpayApi\Response
 */
final class Response extends Parser
{
    /**
     * @var array
     */
    protected $response;

    /**
     * @var array
     */
    protected $raw;

    /**
     * Response constructor.
     * @param string $xml
     * @throws ResponseException
     */
    public function __construct(string $xml)
    {
        $this->raw = $this->parse($xml);
        $this->response = $this->makeResponse($xml);
    }

    /**
     * @return int|null
     */
    public function error()
    {
        return $this->response['error'] ? (int)$this->response['error'] : null;
    }

    /**
     * @return int|null
     */
    public function status()
    {
        return $this->response['status'] ? (int)$this->response['status'] : null;
    }

    /**
     * @return float|null
     */
    public function balance()
    {
        return $this->response['balance'] ? (float)$this->response['balance'] : null;
    }

    /**
     * @return string|null
     */
    public function id()
    {
        return $this->response['id'] ?? null;
    }

    /**
     * @return array
     */
    public function raw(): array
    {
        return $this->raw;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return [
            'error' => $this->error(),
            'status' => $this->status(),
            'balance' => $this->balance(),
            'id' => $this->id()
        ];
    }

    /**
     * @param $xml
     * @return array
     */
    private function makeResponse($xml)
    {
        $return = [
            'error' => '',
            'status' => '',
            'balance' => '',
            'id' => '',
        ];

        $array = [];

        foreach (Arr::collapse($this->raw) as $key => $value) {
            $array[$key] = count($value) > 1 ? $value : Arr::collapse($value);
        }

        // разбор массива для получения баланса
        if (isset($array['extra'])) {

            if (count($array['extra']) !== count($array['extra'], COUNT_RECURSIVE)) {

                foreach ($array['extra'] as $item) {

                    if (isset($item['name']) && $item['name'] === 'balance') {

                        $return['balance'] = $item['value'] ?? '';
                    }
                }
            } else {

                if (isset($array['extra']['name']) && $array['extra']['name'] === 'balance') {

                    $return['balance'] = $array['extra']['value'] ?? '';
                }
            }
        }

        $return['error'] = $array['error']['id'] ?? '';
        $return['status'] = $array['payment']['status'] ?? '';
        $return['id'] = $array['payment']['id'] ?? '';

        // если статус не присутствет в списке, ошибка запроса
        if ($return['status'] && !\array_key_exists($return['status'], Data::STATUS)) {

            $return['error'] = 500;
            $return['status'] = '';
        }

        return $return;
    }
}