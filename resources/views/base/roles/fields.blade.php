<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>

<!-- Guard Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('guard_name', 'Guard Name:') !!}
    {!! Form::text('guard_name', ( isset($role) ? $role->guard_name : 'web'), ['class' => 'form-control','maxlength' => 255, 'readonly' => 'readonly']) !!}
</div>
<!-- List Permission Field -->
@include('base.roles.permission_fields')

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-2">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('base.roles.index') }}" class="btn btn-secondary">Cancel</a>
</div>
