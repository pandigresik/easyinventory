<?php

namespace App\DataTables\Base;

use App\DataTables\BaseDataTable as DataTable;
use App\Models\Base\Menus;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class MenusDataTable extends DataTable
{
    /**
     * example mapping filter column to search by keyword, default use %keyword%.
     */
    private $columnFilterOperator = [
        'parent.name' => \App\DataTables\FilterClass\RelationMatchKeyword::class,
    ];

    /**
     * Build DataTable class.
     *
     * @param mixed $query results from query() method
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        if (!empty($this->columnFilterOperator)) {
            foreach ($this->columnFilterOperator as $column => $operator) {
                $dataTable->filterColumn($column, new $operator($column));
            }
        }

        return $dataTable->addColumn('action', 'base.menus.datatables_actions')
                // ->orderColumn('parent.name', function ($query, $order) {
                //      $query->orderBy('parent_id', $order);
                // })
            ->editColumn('icon', function ($data) {
                $icon = $data->icon ?? '';

                return '<i class="'.$icon.'"> '.$icon.'</i>';
            })->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Menus $model)
    {
        return $model->with(['parent' => function ($q) {
            $q->select(['id', 'name']);
        }])->orderBy('parent_id', 'asc')->orderBy('seq_number', 'asc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom' => '<"row" <"col-md-6"B><"col-md-6 text-end"l>>rtip',
                'stateSave' => true,
                'order' => [[0, 'desc']],
                'buttons' => [
                    [
                        'extend' => 'create',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-plus"></i> '.__('auth.app.create').'',
                    ],
                    [
                        'extend' => 'export',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-download"></i> '.__('auth.app.export').'',
                    ],
                    [
                        'extend' => 'print',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-print"></i> '.__('auth.app.print').'',
                    ],
                    [
                        'extend' => 'reset',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-undo"></i> '.__('auth.app.reset').'',
                    ],
                    [
                        'extend' => 'reload',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-refresh"></i> '.__('auth.app.reload').'',
                    ],
                ],
                'language' => [
                    'url' => url('vendor/datatables/i18n/en-gb.json'),
                ],
                'responsive' => true,
                'fixedHeader' => true,
                'orderCellsTop' => true,
            ])
        ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => new Column(['title' => __('models/menus.fields.name'), 'data' => 'name', 'searchable' => true, 'elmsearch' => 'text']),
            'description' => new Column(['title' => __('models/menus.fields.description'), 'data' => 'description', 'searchable' => true, 'elmsearch' => 'text']),
            'icon' => new Column(['title' => __('models/menus.fields.icon'), 'data' => 'icon', 'searchable' => true, 'elmsearch' => 'text']),
            'route' => new Column(['title' => __('models/menus.fields.route'), 'data' => 'route', 'searchable' => true, 'elmsearch' => 'text']),
            'parent_id' => new Column(['title' => __('models/menus.fields.parent_id'), 'data' => 'parent.name', 'defaultContent' => '-', 'searchable' => true, 'elmsearch' => 'text', 'orderable' => false]),
            'seq_number' => new Column(['title' => __('models/menus.fields.seq_number'), 'data' => 'seq_number', 'searchable' => false, 'orderable' => false]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'menus_datatable_'.time();
    }
}
