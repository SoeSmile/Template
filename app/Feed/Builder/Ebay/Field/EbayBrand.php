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
     * EbayBrand constructor.
     * @param array $item
     */
    public function __construct(array $item)
    {
        if ($item['id'] % 2) {
            $this->show = false;
        }

        parent::__construct($item);
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return '';
    }
}