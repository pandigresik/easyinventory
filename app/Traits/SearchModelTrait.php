<?php

namespace App\Traits;

trait SearchModelTrait
{
    public function scopeSearch($query, $keyword, $columns = [], $operator = 'like', $relativeTables = [])
    {
        $query->where(function ($query) use ($keyword, $columns, $operator) {
            foreach ($columns as $key => $column) {
                $clause = 0 == $key ? 'where' : 'orWhere';
                $textSearch = $keyword;
                switch ($operator) {
                    case 'between':
                        $clause = 0 == $key ? 'whereBetween' : 'orWhereBetween';
                        // no break
                    case 'like_pre':
                        $textSearch = '%'.$textSearch;
                        // no break
                    case 'like_post':
                        $textSearch = $textSearch.'%';
                        // no break
                    default:
                        $textSearch = '%'.$textSearch.'%';
                }

                if ('between' == $operator) {
                    $query->{$clause}($column, $textSearch);
                } else {
                    $query->{$clause}($column, $operator, $textSearch);
                }

                if (!empty($relativeTables)) {
                    $this->filterByRelationship($query, $keyword, $operator, $relativeTables);
                }
            }
        });

        return $query;
    }

    private function filterByRelationship($query, $keyword, $operator, $relativeTables)
    {
        foreach ($relativeTables as $relationship => $relativeColumns) {
            $query->orWhereHas($relationship, function ($relationQuery) use ($keyword, $relativeColumns, $operator) {
                foreach ($relativeColumns as $key => $column) {
                    $clause = 0 == $key ? 'where' : 'orWhere';
                    $textSearch = $keyword;
                    switch ($operator) {
                        case 'between':
                            $clause = 0 == $key ? 'whereBetween' : 'orWhereBetween';
                            // no break
                        case 'like_pre':
                            $textSearch = '%'.$textSearch;
                            // no break
                        case 'like_post':
                            $textSearch = $textSearch.'%';
                            // no break
                        default:
                            $textSearch = '%'.$textSearch.'%';
                    }

                    if ('between' == $operator) {
                        $relationQuery->{$clause}($column, $textSearch);
                    } else {
                        $relationQuery->{$clause}($column, $operator, $textSearch);
                    }
                }
            });
        }

        return $query;
    }
}
