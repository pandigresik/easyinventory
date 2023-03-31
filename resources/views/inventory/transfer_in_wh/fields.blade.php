<!-- Transaction Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('transaction_date', __('models/stockMoves.fields.transaction_date').':', ['class' => 'col-md-3
    col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('transaction_date', null, ['class' => 'form-control datetime', 'required' => 'required'
        ,'data-optiondate' => json_encode( ['locale' => ['format' => config('local.date_format_javascript')
        ]]),'id'=>'transaction_date']) !!}
    </div>
</div>

@if (isset($lines))
<!-- Number Field -->
<div class="form-group row mb-3">
    {!! Form::label('number', __('models/stockMoves.fields.number').':', ['class' => 'col-md-3 col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('number', null, ['class' => 'form-control','maxlength' => 25,'readonly' => 'readonly', 'required' =>
        'required']) !!}
    </div>
</div>
@endif

<!-- References Field -->
<div class="form-group row mb-3">
    {!! Form::label('references', __('models/stockMoves.fields.references').':', ['class' => 'col-md-3 col-form-label'])
    !!}
    <div class="col-md-9">
        {!! Form::text('references', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50, 'required' =>
        'required']) !!}
    </div>
</div>

<!-- Responsbility Field -->
<div class="form-group row mb-3">
    {!! Form::label('responsbility', __('models/stockMoves.fields.responsbility').':', ['class' => 'col-md-3
    col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('responsbility', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50, 'required'
        => 'required']) !!}
    </div>
</div>

<!-- Warehouse Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('warehouse_id', __('models/stockMoves.fields.warehouse_id').':', ['class' => 'col-md-3
    col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::select('warehouse_id', $warehouseItems, null, ['class' => 'form-control select2', 'required' =>
        'required', 'onchange' => 'setOriginWarehouse(this, \'#warehouse_origin_id\')' ]) !!}
    </div>
</div>

<!-- Warehouse Origin Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('warehouse_origin_id', __('models/stockMoves.fields.warehouse_origin_id').':', ['class' => 'col-md-3
    col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::select('warehouse_origin_id', $warehouseOriginItems, null, ['class' => 'form-control select2', 'required' =>
        'required']) !!}
    </div>
</div>


<div>
    <table class="table table-bordered" id="table-stock-move-line">
        <thead>
            <tr>
                <th>Product</th>
                <th>Lot Number / Batch</th>
                <th>Location</th>
                <th>Quantity</th>
                <th>Description</th>                
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(isset($lines))
                @foreach ($lines as $index => $item)
                    @include($baseView.'.item', ['item' => $item, 'lastIndex' => count($lines) == $index + 1 ? 1 : 0])
                @endforeach
            @else
                @include($baseView.'.item', ['item' => null, 'lastIndex' => 1])
            @endif        
        </tbody>        
    </table>    
</div>

@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('#table-stock-move-line tbody').trigger('change')
            if(_.isEmpty($('#warehouse_origin_id').val())){
                $('#warehouse_origin_id').prop('disabled', 1)
            }
        })
        function addRowSelect2(_elm){
            const _tr = $(_elm).closest('tr')
            _tr.find('select.select2').select2('destroy')
            main.addRow($(_elm), reinitSelect2 )
        }
        function reinitSelect2(_newTr){
            _newTr.find('.is-valid').removeClass('is-valid')
            main.initSelect(_newTr.closest('tbody'))
            _newTr.find('select,input').prop('required',1)
            main.initInputmask(_newTr)
        }
        
        function setOriginWarehouse(_elm, _target){
            let _val = $(_elm).val()
            $(_target).prop('disabled', 0)
            $('select[name^="stock_move_line[storage_location_id]"]').val('')
            $('select[name^="stock_move_line[storage_location_id]"]').find('optgroup').prop('disabled', 1)
            $('select[name^="stock_move_line[storage_location_id]"]').trigger('change')
            if(_.isEmpty(_val)){
                $(_target).prop('disabled', 1)
                $(_target).val('')
                $(_target).trigger('change')                                
            }else{
                $(_target).find('option').prop('disabled', 0)
                $(_target).find('option[value='+_val+']').prop('disabled', 1)

                $('select[name^="stock_move_line[storage_location_id]"]').find('optgroup[label="'+$(_elm).find('option:selected').text()+'"]').prop('disabled', 0)
            }
        }
    </script>
@endpush