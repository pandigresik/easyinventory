<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Guard Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('guard_name', 'Guard Name:') !!}
    {!! Form::text('guard_name', ( isset($permission) ? $permission->guard_name : 'web'), ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}    
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-2">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('base.permissions.index') }}" class="btn btn-secondary">Cancel</a>
</div>
