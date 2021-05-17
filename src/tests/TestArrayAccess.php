<?php


namespace Xs\tests;


use PHPUnit\Framework\TestCase;

class TestArrayAccess  extends  TestCase
{
    use CollectionObj;

    public function testSet()
    {
       $obj = $this->getCollection();
       $obj['setAttr'] = "1111";
       $this->assertEquals($obj['setAttr'],"1111");
    }

    public function testGet()
    {
        $obj = $this->getCollection();
        $obj['setAttr'] = "1111";
        $this->assertEquals($obj[0]['a'], 1);
    }
}
