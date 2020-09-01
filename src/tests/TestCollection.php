<?php


namespace Xs\tests;


use PHPUnit\Framework\TestCase;
use Xs\Collection;

class TestCollection extends TestCase
{
    public function testColumn()
    {
        $data = [
            ['a'=>1,'b'=>2],
            ['a'=>2,'b'=>3],
        ];
        $data = Collection::make($data)->column('a')->toArray();
        $this->assertEquals([1,2],$data);
    }


    public function testSum()
    {
        $data = [
            ['a' => 1, 'b' => 2],
            ['a' => 2, 'b' => 3],
        ];
        $sum = Collection::make($data)->sum('a');
        $this->assertEquals(3, $sum);
    }


    public function testAvg()
    {
        $data = [
            ['a' => 1, 'b' => 2],
            ['a' => 2, 'b' => 6],
        ];
        $sum = Collection::make($data)->avg('b');
        $this->assertEquals(4, $sum);
    }
}
