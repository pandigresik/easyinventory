<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/menus.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100, 'required' => 'required']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/menus.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 100,'rows' => 3]) !!}    
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/menus.fields.status').':') !!}    
    {!! Form::select('status', $statusItems, null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder' =>  __('models/menus.option.menu_status_placeholder')]) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', __('models/menus.fields.icon').':') !!}    
    {!! Form::select('icon', $iconItems, null, ['class' => 'form-control select2', 'data-hasicon' => 1 , 'placeholder' => __('models/menus.option.menu_icon_placeholder')]) !!}
</div>

<!-- Route Field -->
<div class="form-group col-sm-6">
    {!! Form::label('route', __('models/menus.fields.route').':') !!}    
    {!! Form::select('route', $routeItems, null, ['class' => 'form-control select2','placeholder' => __('models/menus.option.menu_route_placeholder')]) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', __('models/menus.fields.parent_id').':') !!}    
    {!! Form::select('parent_id', $parentItems, null, ['class' => 'form-control select2', 'placeholder' => __('models/menus.option.menu_parent_placeholder')]) !!}
</div>

<!-- Seq Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seq_number', __('models/menus.fields.seq_number').':') !!}
    {!! Form::number('seq_number', null, ['class' => 'form-control inputmask', 'data-unmask' => 1, 'data-optionmask' => json_encode(config('local.number.integer'))]) !!}
</div>

<!-- Permission Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permission', __('models/menus.fields.permission_id').':') !!}    
    {!! Form::select('permission[]', $permissionItems, $selectedPermission ?? [], ['class' => 'form-control select2', 'multiple' => 'multiple', 'placeholder' => __('models/menus.option.menu_permission_placeholder')]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 mt-2">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('base.menus.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
