<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/uoms.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'required' => 'required']) !!}
</div>
</div>

<!-- Factor Field -->
<div class="form-group row mb-3">
    {!! Form::label('factor', __('models/uoms.fields.factor').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('factor', null, ['class' => 'form-control inputmask', 'data-unmask' => 1, 'data-optionmask' => json_encode(config('local.number.decimal4')), 'required' => 'required']) !!}
</div>
</div>

<!-- Rounding Field -->
<div class="form-group row mb-3">
    {!! Form::label('rounding', __('models/uoms.fields.rounding').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('rounding', null, ['class' => 'form-control inputmask', 'data-unmask' => 1, 'data-optionmask' => json_encode(config('local.number.integer')), 'required' => 'required']) !!}
</div>
</div>

<!-- Uom Type Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('uom_type', __('models/uoms.fields.uom_type_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('uom_type', $uomTypeItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Uom Category Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('uom_category_id', __('models/uoms.fields.uom_category_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('uom_category_id', $uomCategoryItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>
