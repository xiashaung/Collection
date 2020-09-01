<?php


namespace Xs\Traits;


trait ArrayAccess
{
    public function offsetExists($offset)
    {
        return array_key_exists($offset,$this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }
}
