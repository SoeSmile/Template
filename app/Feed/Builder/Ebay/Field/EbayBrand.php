<?php
declare(strict_types=1);

namespace App\Feed\Builder\Ebay\Field;

use App\Feed\Builder\AbstractField;

/**
 * Class EbayBrand
 * @package App\Feed\Builder\Ebay\Field
 */
final class EbayBrand extends AbstractField
{
    /**
     * @return string
     */
    public function getField(): string
    {
        return isset($this->item['brand']) ? (string)$this->item['brand'] : '';
    }
}