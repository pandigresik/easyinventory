<!-- Product Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_id', __('models/stockAdjustmentLines.fields.product_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustmentLine->product_id }}</p>
    </div>
</div>

<!-- Storage Location Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('storage_location_id', __('models/stockAdjustmentLines.fields.storage_location_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustmentLine->storage_location_id }}</p>
    </div>
</div>

<!-- Count Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('count_quantity', __('models/stockAdjustmentLines.fields.count_quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustmentLine->count_quantity }}</p>
    </div>
</div>

<!-- Onhand Quantity Field -->
<div class="form-group row mb-3">
    {!! Form::label('onhand_quantity', __('models/stockAdjustmentLines.fields.onhand_quantity').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustmentLine->onhand_quantity }}</p>
    </div>
</div>

<!-- Transaction Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('transaction_date', __('models/stockAdjustmentLines.fields.transaction_date').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustmentLine->transaction_date }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/stockAdjustmentLines.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustmentLine->description }}</p>
    </div>
</div>

<!-- State Field -->
<div class="form-group row mb-3">
    {!! Form::label('state', __('models/stockAdjustmentLines.fields.state').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustmentLine->state }}</p>
    </div>
</div>

