<?php
namespace Haystack\Functional;

use Haystack\HArray;
use Haystack\HString;

class HaystackReduce
{
    /** @var array */
    private $arr;
    
    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    /**
     * @param callable $func
     * @param $initial
     * @return bool|float|int|HString|HArray
     */
    public function reduce(callable $func, $initial)
    {
        $reduced = array_reduce($this->arr, $func, $initial);

        if ($reduced instanceof \ArrayObject || is_array($reduced)) {
            return new HArray($reduced);
        }

        if (is_string($reduced)) {
            return new HString($reduced);
        }

        return $reduced;
    }
}
