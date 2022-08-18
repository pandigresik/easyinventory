<?php

namespace App\DataTables\FilterClass;

class RelationEndWithKeyword
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
        $builder->whereHas($this->relation, function ($relationQuery) use ($keyword) {
            $relationQuery->where($this->column, 'like', "%{$keyword}");
        });
    }
}
