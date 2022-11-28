<!-- Stock Move Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('stock_move_id', __('models/stockMoveLines.fields.stock_move_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveLine->stock_move_id }}</p>
    </div>
</div>

<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id', __('models/stockMoveLines.fields.product_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveLine->product_id }}</p>
    </div>
</div>

<!-- Storage Location Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('storage_location_id', __('models/stockMoveLines.fields.storage_location_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveLine->storage_location_id }}</p>
    </div>
</div>

<!-- Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('quantity', __('models/stockMoveLines.fields.quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveLine->quantity }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/stockMoveLines.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveLine->description }}</p>
    </div>
</div>

