<?php

namespace Xs;

use Xs\Traits\ArrayAccess;
use Xs\Traits\ArrayWhere;
use Xs\Traits\Macroable;
use Xs\Traits\MagicMehtods;

class  Collection   implements \ArrayAccess,\IteratorAggregate
{

    use Macroable,
        ArrayAccess,
        MagicMehtods,
        ArrayWhere;
    
    private $items = [];

    /**
     * Collection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public static function make(array $items)
    {
        return new static($items);
    }


    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function toArray()
    {
       return $this->items;
    }
}


