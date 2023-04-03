<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/products.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10, 'required' => 'required']) !!}
</div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/products.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50, 'required' => 'required']) !!}
</div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/products.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>
</div>

<!-- Product Category Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_category_id', __('models/products.fields.product_category_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('product_category_id', $productCategoryItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Uom Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('uom_id', __('models/products.fields.uom_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('uom_id', $uomItems, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('file_upload', __('models/products.fields.file_upload').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9">
    @if (isset($product) && !empty($product->image))
    <div>
        <a href="{{ Storage::url('').'?path='.$product->image }}"  target="_blank" rel="noopener noreferrer">file attachment</a>
    </div>    
    @endif     
    {!! Form::file('file_upload') !!}    
</div>
</div>

