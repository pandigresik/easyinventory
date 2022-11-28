<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/storageLocations.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $storageLocation->code }}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/storageLocations.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $storageLocation->name }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/storageLocations.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $storageLocation->description }}</p>
    </div>
</div>

<!-- Warehouse Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('warehouse_id', __('models/storageLocations.fields.warehouse_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $storageLocation->warehouse_id }}</p>
    </div>
</div>

<!-- Parent Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('parent_id', __('models/storageLocations.fields.parent_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $storageLocation->parent_id }}</p>
    </div>
</div>

