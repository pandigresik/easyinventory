<!-- Number Field -->
<div class="form-group row mb-3">
    {!! Form::label('number', __('models/stockAdjustments.fields.number').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustment->number }}</p>
    </div>
</div>

<!-- Transaction Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('transaction_date', __('models/stockAdjustments.fields.transaction_date').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustment->transaction_date }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/stockAdjustments.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockAdjustment->description }}</p>
    </div>
</div>

