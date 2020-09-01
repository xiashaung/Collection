<?php


namespace Xs\Traits;


trait MagicMethods
{
    public function __get($name)
    {
       return $this->offsetGet($name);
    }

    public function __set($name,$value)
    {
        $this->offsetSet($name,$value);
    }

    public function __isset($name)
    {
        return $this->offsetExists($name);
    }

    public function __toString()
    {
        return $this->toJson();
    }
}

