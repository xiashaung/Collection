<?php


namespace Xs\Traits;


trait MagicMehtods
{
    public function __get($name)
    {
       return $this->offsetGet($name);
    }

    public function __set($name,$value)
    {
        $this->offsetSet($name,$value);
    }

    public function __toString()
    {
        return json_encode($this->toArray(),JSON_UNESCAPED_UNICODE);
    }
}

