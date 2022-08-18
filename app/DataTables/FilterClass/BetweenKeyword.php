<?php

namespace App\DataTables\FilterClass;

class BetweenKeyword
{
    private $column;

    public function __construct($name)
    {
        $this->column = $name;
    }

    public function __invoke($builder, $keyword)
    {
        $separator = '__';
        if (is_string($keyword)) {
            $keyword = -1 !== strpos($keyword, $separator) ? explode($separator, $keyword) : $keyword;
        }

        $keyword = is_array($keyword) ? $keyword : [$keyword];
        $builder->whereBetween($this->column, $keyword);
    }
}
