<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/products.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $product->code }}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/products.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $product->name }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/products.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $product->description }}</p>
    </div>
</div>

<!-- Product Category Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('product_category_id', __('models/products.fields.product_category_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $product->product_category->name ?? '' }}</p>
    </div>
</div>

<!-- Uom Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('uom_id', __('models/products.fields.uom_id').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $product->uom->name ?? '' }}</p>
    </div>
</div>

<!-- Uom Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('file_upload', __('models/products.fields.file_upload').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        @if (isset($product) && !empty($product->image))
            <div>
                <img class="img-fluid" src="{{ Storage::url('').'?path='.$product->image }}" />
            </div>    
        @endif
    </div>
</div>

