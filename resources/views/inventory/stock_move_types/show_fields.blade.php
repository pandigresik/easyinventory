<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/stockMoveTypes.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveType->code }}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/stockMoveTypes.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveType->name }}</p>
    </div>
</div>

<!-- Sign Value Field -->
<div class="form-group row mb-3">
    {!! Form::label('sign_value', __('models/stockMoveTypes.fields.sign_value').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveType->sign_value }}</p>
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/stockMoveTypes.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        <p>{{ $stockMoveType->description }}</p>
    </div>
</div>

