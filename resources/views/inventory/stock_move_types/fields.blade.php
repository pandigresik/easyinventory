<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/stockMoveTypes.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10, 'required' => 'required']) !!}
</div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/stockMoveTypes.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50, 'required' => 'required']) !!}
</div>
</div>

<!-- Sign Value Field -->
<div class="form-group row mb-3">
    {!! Form::label('sign_value', __('models/stockMoveTypes.fields.sign_value').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    <label class="checkbox-inline">
        {!! Form::hidden('sign_value', 0) !!}
        {!! Form::checkbox('sign_value', '1', null) !!}
    </label>
</div>
</div>


<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/stockMoveTypes.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>
