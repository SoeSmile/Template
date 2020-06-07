<?php
declare(strict_types=1);

namespace App\Feed\Builder;

/**
 * Class AbstractField
 * @package App\Feed\Builder
 */
abstract class AbstractField
{
    /**
     * @var array
     */
    protected array $item;

    /**
     * @var bool
     */
    protected bool $show = true;

    /**
     * AbstractField constructor.
     * @param array $item
     */
    public function __construct(array $item)
    {
        $this->item = $item;
    }

    /**
     * @return string
     */
    abstract public function getField(): string;

    /**
     * @return bool
     */
    public function isShow(): bool
    {
        return $this->show;
    }
}