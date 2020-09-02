<?php

namespace Xs;

use ArrayIterator;
use Closure;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Xs\Traits\ArrayAccess;
use Xs\Traits\ArrayMath;
use Xs\Traits\ArrayWhere;
use Xs\Traits\Macroable;
use Xs\Traits\MagicMethods;

class  Collection   implements \ArrayAccess, IteratorAggregate, Countable, JsonSerializable,ArrayAble
{

    use Macroable,
        ArrayAccess,
        MagicMethods,
        ArrayWhere,
        ArrayMath;

    private $items;

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
     * @param      $column
     * @param null $indexKey
     * @return static
     */
    public function column($column,$indexKey = null)
    {
        $items = array_column($this->items, $column,$indexKey);
        return new static($items);
    }

    /**
     * 数组去重
     *
     * @param null $column
     * @param int  $sortKey
     * @return $this
     */
    public function unique($column = null,$sortKey = SORT_STRING)
    {
        if (!is_null($column)){
           return $this->column($column)->unique(null,$sortKey);
        }

       $items = array_unique($this->items,$sortKey);
       return new static($items);
    }

    /**
     * 数组切片
     * @param      $offset int 如果是负数 从数组尾部取$length个数组
     * @param null $length
     * @return static
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
    public function each(Closure $callback)
    {
       foreach ($this->items as $key => $item){
           $callback($key,$item);
       }
    }


    /**
     * @param \Closure $callback
     * @return $this
     */
    public function map(Closure $callback)
    {
        $items = array_map($callback,$this->items);
        return new static($items);
    }

    /**
     * 比较数组 返回差值
     *
     * @param array $array
     * @return $this
     */
    public function diff(array $array)
    {
        return new static(array_diff($this->items,$array));
    }


    /**
     * 交换数组的键值
     *
     * @return $this
     */
    public function flip()
    {
       return new static(array_flip($this->items));
    }


    /**
     * 弹出数组堆栈中的最后一个值
     *
     * @return mixed
     */
    public function pop()
    {
       return array_pop($this->items);
    }


    /**
     * @param null   $column
     * @param string $glue
     * @return string
     */
    public function implode($column = null,$glue = '')
    {
        if (!is_null($column)){
            return $this->column($column)->implode(null, $glue);
        }
        return implode($this->items,$glue);
    }

    /**
     * 返回所有数据
     *
     * @return array
     */
    public function all()
    {
       return $this->toArray();
    }


    /**
     * all方法的别名
     *
     * @return array
     */
    public function get()
    {
        return $this->all();
    }

    /**
     * 在数组尾部加入一个参数
     *
     * @param $item
     * @return int
     */
    public function push($item)
    {
       $key = key($this->items);
       if (is_string($key)){
           return array_push($this->items,$item);
       }
       return $this->items[] = $item;
    }

    /**
     * 合并一个数组
     *
     * @param $items
     */
    public function merge($items)
    {
        if ($items instanceof  self){
            $items = $items->toArray();
        }
        $this->items = array_merge($this->items,$items);
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
    public function isNotEmpty(): bool
    {
       return !$this->isEmpty();
    }


    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
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


