<?php
namespace Haystack\Functional;

class HArrayFilterWithValueAndKey
{
    /** @var array */
    protected $arr;

    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    public function filter(callable $func)
    {
        return array_filter($this->arr, $func, ARRAY_FILTER_USE_BOTH);
    }
}