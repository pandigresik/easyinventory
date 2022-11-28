<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/productCategories.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $productCategory->code }}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/productCategories.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $productCategory->name }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/productCategories.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $productCategory->description }}</p>
    </div>
</div>

