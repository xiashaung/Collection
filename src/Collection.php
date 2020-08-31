<?php

namespace Xs;

use Xs\Traits\ArrayAccess;
use Xs\Traits\ArrayWhere;
use Xs\Traits\Macroable;
use Xs\Traits\MagicMehtods;

class  Collection   implements \ArrayAccess,\IteratorAggregate,\Countable
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

    /**
     * @param array $items
     * @return static
     */
    public static function make(array $items)
    {
        return new static($items);
    }

    /**
     * 数组字段
     *
     * @param      $colunm
     * @param null $indexKey
     * @return static
     */
    public function colunm($colunm,$indexKey = null)
    {
        $items = array_column($this->items,$colunm,$indexKey);
        return new static($items);
    }


    /**
     * 数组之和
     *
     * @param null $colunm
     * @return float|int
     */
    public function sum($colunm = null)
    {
        if (!is_null($colunm)) {
            return $this->colunm($colunm)->sum();
        }

        return array_sum($this->items) ?? 0;
    }


    /**
     * 平均数
     *
     * @param null $column
     * @return float|int
     */
    public function avg($column = null)
    {
        if (!is_null($column)) {
            return $this->colunm($column)->avg();
        }

        return $this->sum() / $this->count();
    }

    /**
     * 数组去重
     *
     * @param int $sortKey
     * @return $this
     */
    public function unique($column = null,$sortKey = SORT_STRING)
    {
        if (!is_null($column)){
           return $this->colunm($column)->unique(null,$sortKey);
        }

       $items = array_unique($this->items,$sortKey);
       return new static($items);
    }


    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function count()
    {
       return count($this->items);
    }

    /**
     * @return array
     */
    public function toArray()
    {
       return $this->items;
    }

}


