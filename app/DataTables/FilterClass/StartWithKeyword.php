<?php

namespace App\DataTables\FilterClass;

class StartWithKeyword
{
    private $column;

    public function __construct($name)
    {
        $this->column = $name;
    }

    public function __invoke($builder, $keyword)
    {
        $builder->where($this->column, 'like', "{$keyword}%");
    }
}
