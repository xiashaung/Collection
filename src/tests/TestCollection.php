<?php


namespace Xs\tests;


use PHPUnit\Framework\TestCase;
use Xs\Collection;

class TestCollection extends TestCase
{

    public function getCollection()
    {
        $data = [
            ['a' => 1, 'b' => 2],
            ['a' => 2, 'b' => 3],
        ];
        return Collection::make($data);
    }


    public function testColumn()
    {
        $data = $this->getCollection()->column('a')->toArray();
        $this->assertEquals([1,2],$data);
    }


    public function testSum()
    {
        $data = $this->getCollection()->sum('a');
        $this->assertEquals(3, $data);
    }


    public function testAvg()
    {
        $data = $this->getCollection()->avg('b');
        $this->assertEquals(2.5, $data);
    }

    public function testMin()
    {
        $min = $this->getCollection()->min('a');
        $this->assertEquals(1, $min);
    }

    public function testMax()
    {
        $min = $this->getCollection()->max('b');
        $this->assertEquals(3, $min);
    }
}
