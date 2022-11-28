<!-- Number Field -->
<div class="form-group row mb-3">
    {!! Form::label('number', __('models/stockAdjustments.fields.number').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('number', null, ['class' => 'form-control','maxlength' => 25,'maxlength' => 25, 'required' => 'required']) !!}
</div>
</div>

<!-- Transaction Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('transaction_date', __('models/stockAdjustments.fields.transaction_date').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('transaction_date', null, ['class' => 'form-control datetime', 'required' => 'required' ,'data-optiondate' => json_encode( ['locale' => ['format' => config('local.date_format_javascript') ]]),'id'=>'transaction_date']) !!}
</div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/stockAdjustments.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>
