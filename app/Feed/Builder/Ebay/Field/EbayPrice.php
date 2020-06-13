<?php
declare(strict_types=1);

namespace App\Feed\Builder\Ebay\Field;

use App\Feed\Builder\AbstractField;

final class EbayPrice extends AbstractField
{

    public function getField(): string
    {
        return isset($this->item['price']) ? (string)$this->item['price'] : '';
    }
}