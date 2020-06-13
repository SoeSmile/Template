<?php
declare(strict_types=1);

namespace App\Feed\Builder\Ebay\Field;

use App\Feed\Builder\AbstractField;

/**
 * Class EbayTitle
 * @package App\Feed\Builder\Ebay\Field
 */
final class EbayTitle extends AbstractField
{

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->makeTitle();
    }

    /**
     * @return string
     */
    private function makeTitle(): string
    {
        $title = '';

        foreach ($this->item as $key => $item) {

            if (\in_array($key, ['name', 'brand'], true)) {

                $title .= $title === '' ? $item : ' ' . $item;
            }
        }

        return $title;
    }
}