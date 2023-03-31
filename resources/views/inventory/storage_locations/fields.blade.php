<!-- Code Field -->
<div class="form-group row mb-3">
    {!! Form::label('code', __('models/storageLocations.fields.code').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10, 'required' => 'required']) !!}
</div>
</div>

<!-- Name Field -->
<div class="form-group row mb-3">
    {!! Form::label('name', __('models/storageLocations.fields.name').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50, 'required' => 'required']) !!}
</div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/storageLocations.fields.description').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>
</div>

<!-- Warehouse Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('warehouse_id', __('models/storageLocations.fields.warehouse_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('warehouse_id', $warehouseItems, null, ['class' => 'form-control select2', 'required' => 'required', 'onchange' => 'setStorageLocationOption(this, \'#parent_id\')']) !!}
</div>
</div>

<!-- Parent Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('parent_id', __('models/storageLocations.fields.parent_id').':', ['class' => 'col-md-3 col-form-label']) !!}
<div class="col-md-9"> 
    {!! Form::select('parent_id', $parentItems, null, ['class' => 'form-control select2']) !!}
</div>
</div>

@push('scripts')
    <script type="text/javascript">       
        $(function(){
            if(_.isEmpty($('#parent_id').val())){
                $('#parent_id').prop('disabled', 1)                
            }
            $('#warehouse_id').trigger('change')
        })
        function setStorageLocationOption(_elm, _target){
            let _val = $(_elm).val()
            $(_target).prop('disabled', 0)
            
            if(_.isEmpty(_val)){
                $(_target).prop('disabled', 1)
                $(_target).val('')
                $(_target).trigger('change')
            }else{
                $(_target).find('optgroup').prop('disabled', 1)
                $(_target).find('optgroup[label="'+$(_elm).find('option:selected').text()+'"]').prop('disabled', 0)
            }
        }
    </script>
@endpush
