<?php

namespace App\DataTables\Inventory;

use App\Models\Inventory\StockMove;
use App\DataTables\BaseDataTable as DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class StockMoveDataTable extends DataTable
{
    private $baseRoute;
    private $moveType;
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
        return $dataTable->addColumn('action', function ($item){
            return view('inventory.stock_moves.datatables_actions', ['id' => $item->id, 'baseRoute' => $this->getBaseRoute()]);
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StockMove $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StockMove $model)
    {
        $moveType = $this->getMoveType();
        if($moveType){
            return $model->select([$model->getTable().'.*'])->where('stock_move_type', $moveType)->with(['warehouse'])->newQuery();    
        }
        return $model->select([$model->getTable().'.*'])->with(['warehouse'])->newQuery();
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
            'transaction_date' => new Column(['title' => __('models/stockMoves.fields.transaction_date'),'name' => 'transaction_date', 'data' => 'transaction_date', 'searchable' => true, 'elmsearch' => 'text']),
            'number' => new Column(['title' => __('models/stockMoves.fields.number'),'name' => 'number', 'data' => 'number', 'searchable' => true, 'elmsearch' => 'text']),
            'references' => new Column(['title' => __('models/stockMoves.fields.references'),'name' => 'references', 'data' => 'references', 'searchable' => true, 'elmsearch' => 'text']),
            'responsbility' => new Column(['title' => __('models/stockMoves.fields.responsbility'),'name' => 'responsbility', 'data' => 'responsbility', 'searchable' => true, 'elmsearch' => 'text']),
            'warehouse_id' => new Column(['title' => __('models/stockMoves.fields.warehouse_id'),'name' => 'warehouse_id', 'data' => 'warehouse.name', 'searchable' => true, 'elmsearch' => 'text']),
            'stock_move_type' => new Column(['title' => __('models/stockMoves.fields.stock_move_type'),'name' => 'stock_move_type', 'data' => 'stock_move_type', 'searchable' => true, 'elmsearch' => 'text'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stock_moves_datatable_' . time();
    }

    /**
     * Get the value of baseRoute
     */ 
    public function getBaseRoute()
    {
        return $this->baseRoute;
    }

    /**
     * Set the value of baseRoute
     *
     * @return  self
     */ 
    public function setBaseRoute($baseRoute)
    {
        $this->baseRoute = $baseRoute;

        return $this;
    }

    /**
     * Get the value of moveType
     */ 
    public function getMoveType()
    {
        return $this->moveType;
    }

    /**
     * Set the value of moveType
     *
     * @return  self
     */ 
    public function setMoveType($moveType)
    {
        $this->moveType = $moveType;

        return $this;
    }
}
