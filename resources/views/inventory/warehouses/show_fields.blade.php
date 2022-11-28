<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/warehouses.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $warehouse->code }}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/warehouses.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $warehouse->name }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/warehouses.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $warehouse->description }}</p>
    </div>
</div>

