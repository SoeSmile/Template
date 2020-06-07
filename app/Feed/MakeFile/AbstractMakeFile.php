<?php
declare(strict_types=1);

namespace App\Feed\MakeFile;

abstract class AbstractMakeFile
{
    protected string $path = '';

    protected string $file = '';

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    abstract public function make() : string;

    /**
     * @return array
     */
    protected function getData(): array
    {
        return $this->data;
    }
}