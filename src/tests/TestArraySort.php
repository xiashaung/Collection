<?php


namespace Xs\tests;


use PHPUnit\Framework\TestCase;

class TestArraySort  extends  TestCase
{
     use CollectionObj;

     public function getData()
     {
         return [
             ['a'=>3,'b'=>1],
             ['a'=>1,'b'=>5],
             ['a'=>5,'b'=>2],
         ];
     }

    public function testDesc()
    {
       $obj = $this->getCollection();
       $this->assertSame($obj->orderByDesc('a')->values()->toArray(), [
           ['a' => 5, 'b' => 2],
           ['a' => 3, 'b' => 1],
           ['a' => 1, 'b' => 5],
       ]);
    }


    public function testAsc()
    {
       $obj = $this->getCollection();
       $this->assertSame($obj->orderByAsc('b')->values()->toArray(), [
           ['a' => 3, 'b' => 1],
           ['a' => 5, 'b' => 2],
           ['a' => 1, 'b' => 5],
       ]);
    }
}
