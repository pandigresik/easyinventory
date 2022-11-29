<?php

namespace App\DataTables\Inventory;

use App\Models\Inventory\StockMoveLine;
use App\DataTables\BaseDataTable as DataTable;
use App\Models\Inventory\StorageLocation;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class StockMoveLineDataTable extends DataTable
{
    private $productId;
    private $storageLocationId;
    protected $skipPaging = true;
    /**
    * example mapping filter column to search by keyword, default use %keyword%
    */
    private $columnFilterOperator = [
        'created_at' => \App\DataTables\FilterClass\BetweenDatetimeKeyword::class,
        'stock_move.number' => \App\DataTables\FilterClass\RelationContainKeyword::class,
        // 'product_id' => \App\DataTables\FilterClass\MatchKeyword::class,
        'storage_location_id' => \App\DataTables\FilterClass\InKeyword::class,
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
        return $dataTable;
        // return $dataTable->addColumn('action', 'inventory.stock_move_lines.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StockMoveLine $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StockMoveLine $model)
    {
        return $model->select([$model->getTable().'.*'])
            ->with(['product', 'storageLocation', 'stockMove'])
            ->where(['product_id' => $this->getProductId(), 'storage_location_id' => $this->getStorageLocationId()])->newQuery();
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
                       'extend' => 'export',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
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
            // ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
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
        // $productItem = convertArrayPairValueWithKey(Product::pluck('name', 'id')->toArray());
        $locationItem = convertArrayPairValueWithKey(StorageLocation::whereIsLeaf()->pluck('name', 'id')->toArray());
        return [
            'created_at' => new Column(['title' => __('models/stockMoveLines.fields.created_at'),'name' => 'created_at', 'data' => 'created_at', 'searchable' => true, 'elmsearch' => 'daterange']),
        //    'product_id' => new Column(['title' => __('models/stockMoveLines.fields.product_id'),'name' => 'product_id', 'data' => 'product.name', 'searchable' => true, 'elmsearch' => 'dropdown', 'listItem' => $productItem, 'multiple' => 'multiple']),
            'storage_location_id' => new Column(['title' => __('models/stockMoveLines.fields.storage_location_id'),'name' => 'storage_location_id', 'data' => 'storage_location.name', 'searchable' => true, 'elmsearch' => 'dropdown', 'listItem' => $locationItem, 'multiple' => 'multiple']),
            'stock_move.number' => new Column(['title' => __('models/stockMoves.fields.number'),'name' => 'stock_move.number', 'data' => 'stock_move.number', 'searchable' => true, 'elmsearch' => 'daterange']),            
            'balance' => new Column(['title' => __('models/stockMoveLines.fields.quantity'),'name' => 'balance', 'data' => 'balance', 'searchable' => false, 'elmsearch' => 'text']),
            'description' => new Column(['title' => __('models/stockMoveLines.fields.description'),'name' => 'description', 'data' => 'description', 'searchable' => false, 'elmsearch' => 'text'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stock_move_lines_datatable_' . time();
    }

    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of storageLocationId
     */ 
    public function getStorageLocationId()
    {
        return $this->storageLocationId;
    }

    /**
     * Set the value of storageLocationId
     *
     * @return  self
     */ 
    public function setStorageLocationId($storageLocationId)
    {
        $this->storageLocationId = $storageLocationId;

        return $this;
    }
}
