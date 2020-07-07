<?php

namespace App\Library\Services\AppexNpayApi\Builder;

use App\Library\Services\AppexNpayApi\Data\Data;
use App\Library\Services\AppexNpayApi\Exceptions\ValidatorException;

/**
 * Class BuildPayload
 * @package App\Library\Services\AppexNpayApi
 */
class BuildPayload
{
    use ValidatePayload;

    /**
     * @var array
     */
    private $body = [];

    /**
     * BuildPayload constructor.
     * @param array $body
     * @throws ValidatorException
     */
    public function __construct(array $body)
    {
        $data = $this->validate($body);

        foreach ($data as $key => $item) {
            $this->body[$key] = $this->encoding($item);
        }
    }

    /**
     * @return string
     */
    public function payload(): string
    {
        $type = $this->body['type'];

        return $this->$type();
    }

    /**
     * @return string
     */
    private function new(): string
    {
        $provider = $this->body['provider'] ?? Data::PROVIDER_DEFAULT;

        $request = '<body type="1">
                    <payment 
                    type="' . $this->body['type'] . '" 
                    account="' . $this->body['account'] . '"
                    amount-in="' . $this->body['amount_in'] . '" 
                    amount-out="' . $this->body['amount_out'] . '" 
                    date="' . now()->toW3cString() . '" 
                    tran="' . $this->body['id'] . '" 
                    provider="' . $provider . '"/>
                    </body>';

        return $this->mainBody($request);
    }

    /**
     * @return string
     */
    private function check(): string
    {
        $data = Data::REQUEST_BALANCE;
        $provider = $this->body['provider'] ?? Data::PROVIDER_DEFAULT;

        $request = '<body type="1">
                    <payment 
                    type="' . $this->body['type'] . '" 
                    account="' . $this->encoding($data['account']) . '"
                    amount-in="' . $this->encoding($data['amount_in']) . '" 
                    amount-out="' . $this->encoding($data['amount_out']) . '" 
                    date="' . now()->toW3cString() . '" 
                    tran="' . $this->encoding($data['id']) . '" 
                    provider="' . $provider . '"/>
                    </body>';

        return $this->mainBody($request);
    }

    /**
     * @return string
     */
    private function status(): string
    {
        $request = '<body type="1">
                    <payment 
                    type="' . $this->body['type'] . '" 
                    tran="' . $this->body['id'] . '"/>
                    </body>';

        return $this->mainBody($request);
    }

    /**
     * @param string $request
     * @return string
     */
    private function mainBody(string $request): string
    {
        return '<?xml version="1.0" encoding="windows-1251"?>
                <request version="1.0" date="' . now()->toW3cString() . '">
                <authorization 
                term="' . $this->body['terminal'] . '" 
                user="' . $this->body['login'] . '" 
                password-md5="' . md5($this->body['password']) . '"/>
                ' . $request . '
                </request>';
    }

    /**
     * @param string $str
     * @return bool|false|string
     */
    private function encoding(string $str)
    {
        $str = htmlspecialchars($str);
        return iconv(mb_detect_encoding($str), 'windows-1251', $str);
    }
}