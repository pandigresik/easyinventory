<!-- Stock Move Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('stock_move_id', __('models/stockMoveLines.fields.stock_move_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('stock_move_id', $stockMoveItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id', __('models/stockMoveLines.fields.product_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('product_id', $productItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Storage Location Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('storage_location_id', __('models/stockMoveLines.fields.storage_location_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('storage_location_id', $storageLocationItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('quantity', __('models/stockMoveLines.fields.quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::number('quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/stockMoveLines.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 80,'maxlength' => 80, 'required' => 'required']) !!}
</div>
</div>
