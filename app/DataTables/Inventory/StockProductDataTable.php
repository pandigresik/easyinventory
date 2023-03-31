<?php

namespace App\DataTables\Inventory;

use App\Models\Inventory\StockProduct;
use App\DataTables\BaseDataTable as DataTable;
use App\Models\Inventory\StorageLocation;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class StockProductDataTable extends DataTable
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
        return $dataTable->addColumn('action', 'inventory.stock_products.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StockProduct $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StockProduct $model)
    {
        return $model->select([$model->getTable().'.*'])->with(['product', 'storageLocation' => function($q){
            $q->with(['warehouse']);
        }])->newQuery();
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
        $storageLocationItems = convertArrayPairValueWithKey((new StorageLocation())->pluckWithWarehouse());
        return [
            'product_id' => new Column(['title' => __('models/stockProducts.fields.product_id'),'name' => 'product_id', 'data' => 'product.name', 'searchable' => true, 'elmsearch' => 'text']),
            'warehouse_id' => new Column(['title' => __('models/storageLocations.fields.warehouse_id'),'name' => 'storage_location_id', 'data' => 'storage_location.warehouse.name', 'searchable' => true, 'elmsearch' => 'text']),
            'storage_location_id' => new Column(['title' => __('models/stockProducts.fields.storage_location_id'),'name' => 'storage_location_id', 'data' => 'storage_location.name', 'searchable' => true, 'elmsearch' => 'dropdown', 'listItem' => $storageLocationItems, 'multiple' => 'multiple']),
            'quantity' => new Column(['title' => __('models/stockProducts.fields.quantity'),'name' => 'quantity', 'data' => 'quantity', 'searchable' => false, 'elmsearch' => 'text'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stock_products_datatable_' . time();
    }
}
