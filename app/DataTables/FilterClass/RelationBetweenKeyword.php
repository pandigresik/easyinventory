<?php

namespace App\DataTables\FilterClass;

class RelationBetweenKeyword
{
    private $column;
    private $relation;

    public function __construct($name)
    {
        list($this->relation, $this->column) = explode('.', $name);
        $this->relation = \Str::camel($this->relation);
    }

    public function __invoke($builder, $keyword)
    {
        $separator = '__';
        if (is_string($keyword)) {
            $keyword = -1 !== strpos($keyword, $separator) ? explode($separator, $keyword) : $keyword;
        }
        $keyword = is_array($keyword) ? $keyword : [$keyword];
        $builder->whereHas($this->relation, function ($relationQuery) use ($keyword) {
            $relationQuery->whereBetween($this->column, $keyword);
        });
    }
}
