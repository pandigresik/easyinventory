<!-- Transaction Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('transaction_date', __('models/stockOutMoves.fields.transaction_date').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMove->transaction_date }}</p>
    </div>
</div>

<!-- Number Field -->
<div class="form-group row mb-3">
    {!! Form::label('number', __('models/stockOutMoves.fields.number').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMove->number }}</p>
    </div>
</div>

<!-- References Field -->
<div class="form-group row mb-3">
    {!! Form::label('references', __('models/stockOutMoves.fields.references').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMove->references }}</p>
    </div>
</div>

<!-- Responsbility Field -->
<div class="form-group row mb-3">
    {!! Form::label('responsbility', __('models/stockOutMoves.fields.responsbility').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMove->responsbility }}</p>
    </div>
</div>

<!-- Warehouse Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('warehouse_id', __('models/stockOutMoves.fields.warehouse_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMove->warehouse_id }}</p>
    </div>
</div>

<!-- Stock Move Type Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('stock_move_type_id', __('models/stockOutMoves.fields.stock_move_type_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMove->stock_move_type_id }}</p>
    </div>
</div>

