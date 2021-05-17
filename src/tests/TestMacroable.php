<?php


namespace Xs\tests;


use PHPUnit\Framework\TestCase;
use Xs\Collection;

class TestMacroable  extends  TestCase
{
    use CollectionObj;

    public function testCall()
    {
        Collection::macro("firstValue",function($key){
            return $this->first()[$key];
        });
        $value = $this->getCollection()->firstValue('a');
        $this->assertEquals($value,1);
    }

    public function testCallStatic()
    {
        Collection::macro("toArrayObject", function ($array){
            return new \ArrayObject($array);
        });
        $value = Collection::toArrayObject($this->getData());
        $this->assertEquals(get_class($value), \ArrayObject::class);
    }
}
