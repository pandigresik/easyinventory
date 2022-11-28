<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/storageLocations.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10, 'required' => 'required']) !!}
</div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/storageLocations.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50, 'required' => 'required']) !!}
</div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/storageLocations.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>

<!-- Warehouse Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('warehouse_id', __('models/storageLocations.fields.warehouse_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('warehouse_id', $warehouseItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Parent Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('parent_id', __('models/storageLocations.fields.parent_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('parent_id', $parentItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>
