<?php

namespace App\DataTables\Inventory;

use App\Models\Inventory\Product;
use App\DataTables\BaseDataTable as DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ProductDataTable extends DataTable
{
    /**
    * example mapping filter column to search by keyword, default use %keyword%
    */
    private $columnFilterOperator = [
        //'name' => \App\DataTables\FilterClass\MatchKeyword::class,        
    ];
    
    private $mapColumnSearch = [
        //'entity.name' => 'entity_id',
    ];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        if (!empty($this->columnFilterOperator)) {
            foreach ($this->columnFilterOperator as $column => $operator) {
                $columnSearch = $this->mapColumnSearch[$column] ?? $column;
                $dataTable->filterColumn($column, new $operator($columnSearch));                
            }
        }
        return $dataTable->addColumn('action', 'inventory.products.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->select([$model->getTable().'.*'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $buttons = [
                    [
                       'extend' => 'create',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    ],
                    [
                       'extend' => 'export',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    ],
                    [
                       'extend' => 'import',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-upload"></i> ' .__('auth.app.import').''
                    ],
                    [
                       'extend' => 'print',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                    ],
                    [
                       'extend' => 'reset',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                    ],
                    [
                       'extend' => 'reload',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
                    ],
                ];
                
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom'       => '<"row" <"col-md-6"B><"col-md-6 text-end"l>>rtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => $buttons,
                 'language' => [
                   'url' => url('vendor/datatables/i18n/en-gb.json'),
                 ],
                 'responsive' => true,
                 'fixedHeader' => true,
                 'orderCellsTop' => true     
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'code' => new Column(['title' => __('models/products.fields.code'),'name' => 'code', 'data' => 'code', 'searchable' => true, 'elmsearch' => 'text']),
            'name' => new Column(['title' => __('models/products.fields.name'),'name' => 'name', 'data' => 'name', 'searchable' => true, 'elmsearch' => 'text']),
            'description' => new Column(['title' => __('models/products.fields.description'),'name' => 'description', 'data' => 'description', 'searchable' => true, 'elmsearch' => 'text']),
            'product_category_id' => new Column(['title' => __('models/products.fields.product_category_id'),'name' => 'product_category_id', 'data' => 'product_category_id', 'searchable' => true, 'elmsearch' => 'text']),
            'uom_id' => new Column(['title' => __('models/products.fields.uom_id'),'name' => 'uom_id', 'data' => 'uom_id', 'searchable' => true, 'elmsearch' => 'text'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'products_datatable_' . time();
    }
}
