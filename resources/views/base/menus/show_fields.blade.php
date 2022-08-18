<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/menus.fields.name').':') !!}
    <p>{{ $menus->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/menus.fields.description').':') !!}
    <p>{{ $menus->description }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/menus.fields.status').':') !!}
    <p>{{ $menus->status }}</p>
</div>

<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/menus.fields.icon').':') !!}
    <p>{{ $menus->icon }}</p>
</div>

<!-- Route Field -->
<div class="form-group">
    {!! Form::label('route', __('models/menus.fields.route').':') !!}
    <p>{{ $menus->route }}</p>
</div>

<!-- Parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', __('models/menus.fields.parent_id').':') !!}
    <p>{{ $menus->parent_id }}</p>
</div>

<!-- Seq Number Field -->
<div class="form-group">
    {!! Form::label('seq_number', __('models/menus.fields.seq_number').':') !!}
    <p>{{ $menus->seq_number }}</p>
</div>

