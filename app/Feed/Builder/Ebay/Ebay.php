<?php
declare(strict_types=1);

namespace App\Feed\Builder\Ebay;

use App\Feed\Builder\AbstractBuilder;
use App\Feed\Builder\Ebay\Field\EbayBrand;
use App\Feed\Builder\Ebay\Field\EbayName;
use App\Feed\Builder\Ebay\Field\EbayPrice;
use App\Feed\Builder\Ebay\Field\EbayTitle;

final class Ebay extends AbstractBuilder
{
    protected array $fields = [
        'prod_name' => EbayName::class,
        'prod_price' => EbayPrice::class,
        'prod_brand' => EbayBrand::class,
        'prod_title' => EbayTitle::class,
        'prod_path' => 'path'
    ];
}