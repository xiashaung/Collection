<?php


namespace Xs\Traits;


trait ArraySort
{

    /**
     * 排序
     *
     * @param      $column  mixed 排序字段
     * @param int  $option
     * @param bool $desc  是否是倒序
     * @return $this
     */
    public function sort($column,$option = SORT_REGULAR,bool $desc = false)
    {
        if (!$column) return $this;

        $result = [];

        foreach ($this->items as $key => $item){
            $result[$key] = $this->itemValue($item,$column);
        }

        $desc ? arsort($result,$option) : asort($result,$option);

        foreach ($result as $key => $value){
            $result[$key] = $this->items[$key];
        }

        return new static($result);
    }


    /**
     * 正序排序
     *
     * @param     $column
     * @param int $option
     * @return \Xs\Traits\ArraySort
     */
    public function orderBy($column,$option = SORT_REGULAR)
    {
        return $this->sort($column,$option);
    }


    /**
     * 倒序查找
     *
     * @param     $column
     * @param int $option
     * @return \Xs\Traits\ArraySort
     */
    public function orderByDesc($column, $option = SORT_REGULAR)
    {
        return $this->sort($column, $option,true);

    }

    /**
     * 正序排序
     *
     * @param     $column
     * @param int $option
     * @return \Xs\Traits\ArraySort
     */
    public function orderByAsc($column, $option = SORT_REGULAR)
    {
        return $this->sort($column, $option);
    }
}
