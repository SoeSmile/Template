<?php
declare(strict_types=1);

namespace App\Feed\Builder\Ebay\Field;

use App\Feed\Builder\AbstractField;

/**
 * Class EbayName
 * @package App\Feed\Builder\Ebay\Field
 */
final class EbayName extends AbstractField
{

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->item['name'] ?? '';
    }
}