<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', 'Name:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9"> 
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Email Field -->
<div class="form-group row mb-3">
    {!! Form::label('email', 'Email:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9"> 
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Password Field -->
@if (!isset($user))
<div class="form-group row mb-3">
    {!! Form::label('password', 'Password:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9"> 
    {!! Form::password('password', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>
@endif

<!-- List Permission Field -->
<div class="form-group row mb-3">
    {!! Form::label('role', 'Role:', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-9">
    @include('base.users.role_fields')
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-2">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('base.users.index') }}" class="btn btn-secondary">Cancel</a>
</div>
