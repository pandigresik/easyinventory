<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id', __('models/stockAdjustmentLines.fields.product_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('product_id', $productItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Storage Location Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('storage_location_id', __('models/stockAdjustmentLines.fields.storage_location_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('storage_location_id', $storageLocationItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Count Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('count_quantity', __('models/stockAdjustmentLines.fields.count_quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::number('count_quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>

<!-- Onhand Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('onhand_quantity', __('models/stockAdjustmentLines.fields.onhand_quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::number('onhand_quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>

<!-- Transaction Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('transaction_date', __('models/stockAdjustmentLines.fields.transaction_date').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('transaction_date', null, ['class' => 'form-control datetime', 'required' => 'required' ,'data-optiondate' => json_encode( ['locale' => ['format' => config('local.date_format_javascript') ]]),'id'=>'transaction_date']) !!}
</div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/stockAdjustmentLines.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>

<!-- State Field -->
<div class="form-group row mb-3">
    {!! Form::label('state', __('models/stockAdjustmentLines.fields.state').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('state', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>
