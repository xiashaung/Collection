<?php

namespace Xs;

use Xs\Traits\ArrayAccess;
use Xs\Traits\ArrayMath;
use Xs\Traits\ArrayWhere;
use Xs\Traits\Macroable;
use Xs\Traits\MagicMehtods;

class  Collection   implements \ArrayAccess,\IteratorAggregate,\Countable,\JsonSerializable
{

    use Macroable,
        ArrayAccess,
        MagicMehtods,
        ArrayWhere,
        ArrayMath;
    
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
     * 数组切片
     * @param      $offset int 如果是负数 从数组尾部取$length个数组
     * @param null $length
     * @return $this
     */
    public function slice($offset,$length = null)
    {
        $items = array_slice($this->items,$offset,$length,true);
        return new static($items);
    }

    /**
     * 使用回调函数依次处理数组
     * 
     * @param $callback
     */
    public function each(\Closure $callback)
    {
       foreach ($this->items as $key => $item){
           $callback($key,$item);
       }
    }


    /**
     * @param \Closure $callback
     * @return $this
     */
    public function map(\Closure $callback)
    {
        $items = array_map($callback,$this->items);
        return new static($items);
    }


    /**
     * @return $this
     */
    public function keys()
    {
        return new static(array_keys($this->items));
    }

    /**
     * @return $this
     */
    public function values()
    {
       return new static(array_values($this->items));
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
       return empty($this->items);
    }


    /**
     * @return bool
     */
    public function isNotEmpty()
    {
       return !$this->isEmpty();
    }


    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @return int
     */
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


    public function toJson($option = JSON_UNESCAPED_UNICODE)
    {
        return json_encode($this->items,$option);
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }

}


