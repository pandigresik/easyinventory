<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id', __('models/stockProducts.fields.product_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('product_id', $productItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Storage Location Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('storage_location_id', __('models/stockProducts.fields.storage_location_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('storage_location_id', $storageLocationItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('quantity', __('models/stockProducts.fields.quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::number('quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>
