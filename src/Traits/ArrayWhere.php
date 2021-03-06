<?php


namespace Xs\Traits;


use Xs\Exceptions\WhereOperationNotAllowedException;

trait ArrayWhere
{

    private $whereOperate = ['=', '==', '===', '>', '>=', '<', '<=', '!=', '!=='];


    /**
     * @param      $name
     * @param      $operate
     * @param null $value
     * @return static
     */
    public function where($name, $operate, $value = null)
    {
        if (func_num_args() === 2) {
            $value = $operate;
            $operate = '==';
        }

        if (!in_array($operate, $this->whereOperate)) {
            throw new WhereOperationNotAllowedException(sprintf("where operate %s not allowed", $operate));
        }

        return $this->filter($this->prepareForWhere($name, $operate, $value));
    }


    /**
     * @param      $name
     * @param      $operate
     * @param null $value
     * @return \Closure
     */
    private function prepareForWhere($name, $operate, $value = null)
    {
        return function ($item) use ($name, $operate, $value){
            $itemValue = $this->itemValue($item, $name);
            switch ($operate) {
                case '=':
                case '==':
                    return $itemValue == $value;
                case '===':
                    return $itemValue === $value;
                case '!=':
                    return $itemValue != $value;
                case '!==':
                    return $itemValue !== $value;
                case '>':
                    return $itemValue > $value;
                case '>=':
                    return $itemValue >= $value;
                case '<':
                    return $itemValue < $value;
                case '<=':
                    return $itemValue <= $value;
            }
        };
    }

    /**
     * @param       $name
     * @param array $values
     * @param bool  $strict
     * @return static
     */
    public function whereIn($name, array $values, bool $strict = false)
    {
        return $this->filter(function ($item) use ($name, $values, $strict){
            $itemValue = $this->itemValue($item, $name);
            return in_array($itemValue, $values, $strict);
        });
    }

    /**
     * @param       $name
     * @param array $values
     * @param bool  $strict
     */
    public function whereNotIn($name, array $values, bool $strict = false)
    {
        return $this->filter(function ($item) use ($name, $values, $strict){
            $itemValue = $this->itemValue($item, $name);
            return !in_array($itemValue, $values, $strict);
        });
    }


    /**
     * @param      $name
     * @param      $operate
     * @param null $value
     * @return   mixed
     * @throws \Xs\Exceptions\WhereOperationNotAllowedExcetion
     */
    public function whereFirst($name, $operate, $value = null)
    {
        return $this->where(...func_get_args())->first();
    }


    /**
     * @param null $callback
     * @param null $default
     * @return mixed|null
     */
    public function first($callback = null, $default = null)
    {
        if (is_null($callback)) {
            foreach ($this->items as $item) {
                return $item;
            }
        }
        foreach ($this->items as $key => $item) {
            if (call_user_func($callback, $item, $key)) {
                return $item;
            }
        }
        return $default;
    }


    /**
     * @param      $item
     * @param      $key
     * @param null $default
     * @return mixed|null
     */
    private function itemValue($item, $key, $default = null)
    {
        if (!is_array($item) || !isset($item[$key])) return $default;

        if (!isset($item[$key])) return $default;

        $value = $item[$key];

        return $value ?? $default;
    }


    /**
     * @param $callback
     * @return static
     */
    public function filter($callback)
    {
        $items = array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH);
        return new static($items);
    }
}
