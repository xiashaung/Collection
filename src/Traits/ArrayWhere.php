<?php


namespace Xs\Traits;


trait ArrayWhere
{
    public function where($name, $operate,$value = null)
    {
        if (func_num_args() === 2){
           $value = $operate;
           $operate = '==';
        }
        $items = $this->filter($this->prepareForWhere($name,$operate,$value));
        return new static($items);
    }

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


    
    private function itemValue($item,$key,$default = null)
    {
       if (!is_array($item) || !isset($item[$key])) return $default;

       if (!isset($item[$key])) return $default;

       $value = $item[$key];

       return $value ?? $default;
    }

    private function filter($callback)
    {
         return array_filter($this->items,$callback,ARRAY_FILTER_USE_BOTH);
    }
}
