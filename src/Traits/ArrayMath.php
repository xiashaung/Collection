<?php


namespace Xs\Traits;


trait ArrayMath
{
    /**
     * 数组之和
     *
     * @param null $colunm
     * @return float|int
     */
    public function sum($colunm = null)
    {
        if (!is_null($colunm)) {
            return $this->colunm($colunm)->sum();
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
            return $this->colunm($column)->avg();
        }

        return $this->sum() / $this->count();
    }

    /**
     * @param null $column
     * @return mixed
     */
    public function max($column = null)
    {
        if (!is_null($column)) {
            return $this->colunm($column)->max();
        }

        return max($this->items);
    }

    /**
     * @param null $column
     * @return mixed
     */
    public function min($column = null)
    {
        if (!is_null($column)) {
            return $this->colunm($column)->min();
        }

        return min($this->items);
    }
}
