<?php


namespace Xs\Traits;


trait ArrayMath
{
    /**
     * 数组之和
     *
     * @param null $column
     * @return float|int
     */
    public function sum($column = null)
    {
        if (!is_null($column)) {
            return $this->column($column)->sum();
        }

        return array_sum($this->items) ?? 0;
    }


    /**
     * 平均数
     *
     * @param null $column
     * @return float|int
     */
    public function avg($column = null)
    {
        if (!is_null($column)) {
            return $this->column($column)->avg();
        }

        return $this->sum() / $this->count();
    }

    /**
     * 最大数
     * 
     * @param null $column
     * @return mixed
     */
    public function max($column = null)
    {
        if (!is_null($column)) {
            return $this->column($column)->max();
        }

        return max($this->items);
    }

    /**
     * 最小数
     *
     * @param null $column
     * @return mixed
     */
    public function min($column = null)
    {
        if (!is_null($column)) {
            return $this->column($column)->min();
        }

        return min($this->items);
    }
}
