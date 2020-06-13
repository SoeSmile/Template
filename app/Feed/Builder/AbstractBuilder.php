<?php
declare(strict_types=1);

namespace App\Feed\Builder;

/**
 * Class AbstractBuilder
 * @package App\Feed\Builder
 */
abstract class AbstractBuilder
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @var array
     */
    protected array $fields = [];

    /**
     * @var bool
     */
    protected bool $validate = true;

    /**
     * AbstractBuilder constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->build($data);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    private function build(array $data): void
    {
        foreach ($data as $item) {

            if ($this->validate) {
                $this->data[] = $this->makeField($item);
            }
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function makeField(array $data): array
    {
        $array = [];

        foreach ($this->fields as $key => $class) {

            if (\class_exists($class)) {

                $field = new $class($data);

                if ($field instanceof AbstractField && $field->isShow()) {

                    $array[$key] = $field->getField();
                }
            }

            if (isset($data[$class])) {

                $array[$key] = (string)$data[$class];
            }
        }

        return $array;
    }
}