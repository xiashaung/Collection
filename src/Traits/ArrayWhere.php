<?php


namespace Xs\Traits;


trait ArrayWhere
{
    /**
     * @param      $name
     * @param      $operate
     * @param null $value
     * @return static
     */
    public function where($name, $operate,$value = null)
    {
        if (func_num_args() === 2){
           $value = $operate;
           $operate = '==';
        }
        return $this->filter($this->prepareForWhere($name,$operate,$value));
    }

    /**
     * @param      $name
     * @param      $operate
     * @param null $value
     * @return \Closure
     */
    private function prepareForWhere($name, $operate, $value = null)
    {
        return function($item)use($name, $operate, $value){
            $itemValue =  $this->itemValue($item,$name);
            switch ($operate){
                case '==': return $itemValue == $value;
                case '===': return $itemValue === $value;
                case '!=': return $itemValue != $value;
                case '!==': return $itemValue !== $value;
                case '>': return $itemValue > $value;
                case '>=': return $itemValue >= $value;
                case '<': return $itemValue < $value;
                case '<=': return $itemValue <= $value;
            }
        };
    }

    /**
     * @param       $name
     * @param array $value
     * @param bool  $strict
     * @return static
     */
    public function whereIn($name,array $value,bool $strict = false)
    {
        return $this->filter(function($item)use($name,$value,$strict){
            $itemValue = $this->itemValue($item,$name);
            return in_array($itemValue,$value,$strict);
        });
    }


    
    private function itemValue($item,$key,$default = null)
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
    private function filter($callback)
    {
         $items = array_filter($this->items,$callback,ARRAY_FILTER_USE_BOTH);
        return new static($items);
    }
}
