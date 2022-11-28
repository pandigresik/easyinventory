<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/uoms.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $uom->name }}</p>
    </div>
</div>

<!-- Category Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('category_id', __('models/uoms.fields.category_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $uom->category_id }}</p>
    </div>
</div>

<!-- Factor Field -->
<div class="form-group row mb-3">
    {!! Form::label('factor', __('models/uoms.fields.factor').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $uom->factor }}</p>
    </div>
</div>

<!-- Rounding Field -->
<div class="form-group row mb-3">
    {!! Form::label('rounding', __('models/uoms.fields.rounding').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $uom->rounding }}</p>
    </div>
</div>

<!-- Uom Type Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('uom_type_id', __('models/uoms.fields.uom_type_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $uom->uom_type_id }}</p>
    </div>
</div>

<!-- Uom Category Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('uom_category_id', __('models/uoms.fields.uom_category_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $uom->uom_category_id }}</p>
    </div>
</div>

