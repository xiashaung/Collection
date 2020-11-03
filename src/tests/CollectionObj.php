<?php


namespace Xs\tests;


use Xs\Collection;

trait CollectionObj
{
    /**
     * @return \int[][]
     */
    public function getData()
    {
        return [
            ['a'=>1,'b'=>2],
            ['a'=>2,'b'=>3],
        ];
    }

    /**
     * @return \Xs\Collection
     */
    public function getCollection()
    {
       return Collection::make($this->getData());
    }
}
