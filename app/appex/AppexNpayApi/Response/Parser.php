<?php

namespace App\Library\Services\AppexNpayApi\Response;

use App\Library\Services\AppexNpayApi\Exceptions\ResponseException;

/**
 * Class Parser
 * @package App\Library\Services\AppexNpayApi\Response
 */
class Parser
{
    /**
     * @param string $str
     * @return array
     * @throws ResponseException
     */
    public function parse(string $str): array
    {
        try {
            $xml = new \SimpleXMLElement($str);

        } catch (\Exception $e) {

            throw new ResponseException('Данные не являются XML структурой');
        }

        return $this->xmlToArray($xml);
    }

    /**
     * парс xml в массив
     *
     * @param $xml
     * @param array $array
     * @return array
     */
    private function xmlToArray($xml, $array = []): array
    {
        foreach ($xml as $item) {
            if ($item->count() === 0) {
                $array[$item->getName()][] = $this->getXmlItem($item);
            } else {
                $array[$item->getName()] = $this->xmlToArray($item);
            }
        }

        return $array;
    }

    /**
     * возврат элемента xml
     *
     * @param $data
     * @return array|string
     */
    private function getXmlItem($data)
    {
        $array = (array)$data;

        return count($array['@attributes']) > 1 ? $array['@attributes'] : $array['@attributes'][0];
    }
}