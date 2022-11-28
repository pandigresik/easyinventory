<!-- Transaction Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('transaction_date', __('models/stockMoves.fields.transaction_date').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('transaction_date', null, ['class' => 'form-control datetime', 'required' => 'required' ,'data-optiondate' => json_encode( ['locale' => ['format' => config('local.date_format_javascript') ]]),'id'=>'transaction_date']) !!}
</div>
</div>

<!-- Number Field -->
<div class="form-group row mb-3">
    {!! Form::label('number', __('models/stockMoves.fields.number').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('number', null, ['class' => 'form-control','maxlength' => 25,'maxlength' => 25, 'required' => 'required']) !!}
</div>
</div>

<!-- References Field -->
<div class="form-group row mb-3">
    {!! Form::label('references', __('models/stockMoves.fields.references').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('references', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50, 'required' => 'required']) !!}
</div>
</div>

<!-- Responsbility Field -->
<div class="form-group row mb-3">
    {!! Form::label('responsbility', __('models/stockMoves.fields.responsbility').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('responsbility', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50, 'required' => 'required']) !!}
</div>
</div>

<!-- Warehouse Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('warehouse_id', __('models/stockMoves.fields.warehouse_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('warehouse_id', $warehouseItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Stock Move Type Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('stock_move_type_id', __('models/stockMoves.fields.stock_move_type_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('stock_move_type_id', $stockMoveTypeItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>
