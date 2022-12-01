<?php

namespace App\DataTables\Inventory;

use App\Models\Inventory\StockAdjustment;
use App\DataTables\BaseDataTable as DataTable;
use App\Models\Inventory\Warehouse;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class StockAdjustmentDataTable extends DataTable
{
    /**
    * example mapping filter column to search by keyword, default use %keyword%
    */
    private $columnFilterOperator = [
        'warehouse_id' => \App\DataTables\FilterClass\InKeyword::class,
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
        return $dataTable->addColumn('action', 'inventory.stock_adjustments.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StockAdjustment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StockAdjustment $model)
    {
        return $model->select([$model->getTable().'.*'])->with(['warehouse'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $buttonWarehouses = [];
        $warehouse = Warehouse::get();
        foreach($warehouse as $w){
            $buttonWarehouses[] = [
                'className' => 'btn btn-default btn-sm no-corner',
                'text' => '<i class="fa cil-library-building"></i> '.$w->name,
                'action' => <<<FUNC
            function(e, dt, button, config){
                window.location = window.location.href.replace(/\/+$/, '') + '/create?warehouse_id={$w->id}'
            }
FUNC
        ];
        }
        
        $buttons = [                    
                    [
                        'extend' => 'collection',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').'',
                        'buttons' => $buttonWarehouses            
                    ],
                    [
                       'extend' => 'export',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    ],
                    // [
                    //    'extend' => 'import',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-upload"></i> ' .__('auth.app.import').''
                    // ],
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
        $warehouseItems = convertArrayPairValueWithKey(Warehouse::pluck('name', 'id')->toArray()); 
        return [
            'number' => new Column(['title' => __('models/stockAdjustments.fields.number'),'name' => 'number', 'data' => 'number', 'searchable' => true, 'elmsearch' => 'text']),
            'transaction_date' => new Column(['title' => __('models/stockAdjustments.fields.transaction_date'),'name' => 'transaction_date', 'data' => 'transaction_date', 'searchable' => true, 'elmsearch' => 'text']),
            'warehouse_id' => new Column(['title' => __('models/stockAdjustments.fields.warehouse_id'),'name' => 'warehouse_id', 'data' => 'warehouse.name', 'searchable' => true, 'elmsearch' => 'dropdown', 'listItem' => $warehouseItems, 'multiple' => 'multiple']),
            'description' => new Column(['title' => __('models/stockAdjustments.fields.description'),'name' => 'description', 'data' => 'description', 'searchable' => true, 'elmsearch' => 'text'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stock_adjustments_datatable_' . time();
    }
}
