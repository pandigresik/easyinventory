@if (isset($id))
<!-- Number Field -->
<div class="form-group row mb-3">
    {!! Form::label('number', __('models/stockAdjustments.fields.number').':', ['class' => 'col-md-3 col-form-label'])
    !!}
    <div class="col-md-9">
        {!! Form::text('number', null, ['class' => 'form-control','maxlength' => 25,'readonly' => 'readonly', 'required' =>
        'required']) !!}
    </div>
</div>    
@endif

<!-- Warehouse Id Field -->
<div class="form-group row mb-3">
    {!! Form::label('warehouse_id', __('models/stockMoves.fields.warehouse_id').':', ['class' => 'col-md-3
    col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::select('warehouse_id', $warehouseItems, null, ['class' => 'form-control select2', 'required' =>
        'required']) !!}
    </div>
</div>

<!-- Transaction Date Field -->
<div class="form-group row mb-3">
    {!! Form::label('transaction_date', __('models/stockAdjustments.fields.transaction_date').':', ['class' => 'col-md-3
    col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::text('transaction_date', null, ['class' => 'form-control datetime', 'required' => 'required'
        ,'data-optiondate' => json_encode( ['locale' => ['format' => config('local.date_format_javascript')
        ]]),'id'=>'transaction_date']) !!}
    </div>
</div>

<!-- Description Field -->
<div class="form-group row mb-3">
    {!! Form::label('description', __('models/stockAdjustments.fields.description').':', ['class' => 'col-md-3
    col-form-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'required' => 'required']) !!}
    </div>
</div>

<div>
    <table class="table table-bordered text-center" id="table-stock-adjustment-line">
        <thead>
            <tr class="align-middle">
                <th>Product</th>
                <th>Location</th>
                <th>Quantity</th>                  
                <th>Keterangan</th>                
                <th></th>
            </tr>            
        </thead>
        <tbody>
            @if(isset($lines))
                @foreach ($lines as $index => $item)
                    @include('inventory.stock_adjustments.item', ['item' => $item, 'lastIndex' => count($lines) == $index + 1 ? 1 : 0])
                @endforeach
            @else                
                @include('inventory.stock_adjustments.item', ['item' => null, 'lastIndex' => 1])
            @endif
        </tbody>
    </table>
</div>

@push('scripts')
<script type="text/javascript">
    let _firstClickAddButton = false
    $(function () {
        $('#table-stock-adjustment-line tbody').trigger('change')
    })

    function validForm(_elm){
        const _tr = $('#table-stock-adjustment-line tbody>tr')        
        let _product_storage, _product_id, _location_id, _product_storage_registered = {}
        let _valid = true, _onhand
        _tr.each(function(index, item){            
            _product_id = $(item).find('select[name^="stock_adjustment_line[product_id]"]').val()
            _location_id = $(item).find('select[name^="stock_adjustment_line[storage_location_id]"]').val()
            _product_storage = [_product_id,'__',_location_id]            
            _onhand = $(item).find('input[name^="stock_adjustment_line[onhand_quantity]"]').val()

            if(_product_id == '' || _location_id == ''){
                main.alertDialog('Warning', 'produk dan lokasi pada baris '+(index + 1)+' harus dipilih')
                _valid = false
                return _valid
            }

            if(_onhand == ''){
                main.alertDialog('Warning', 'quantity onhand dan count pada baris '+(index + 1)+' harus diisi')
                _valid = false
                return _valid
            }


            // pastikan kombinasi product_id dan storage_location_id tidak ada yang kembar
            if(_product_storage_registered[_product_storage.join('')] == undefined){
                _product_storage_registered[_product_storage.join('')] = (index + 1)
            }else{
                main.alertDialog('Warning', 'Kombinasi product dan lokasi pada baris '+(index + 1)+' sudah didefinisikan di baris '+_product_storage_registered[_product_storage.join('')])
                _valid = false
                return _valid
            }
        })
        if(_valid){
            $(_elm).closest('form').submit()
        }
    }

    function addRowSelect2(_elm) {
        const _tr = $(_elm).closest('tr')
        _tr.find('select.select2').select2('destroy')
        main.addRow($(_elm), reinitSelect2)
    }

    function reinitSelect2(_newTr) {
        if(!_firstClickAddButton){
            _newTr.prev('tr').find('td:last button').remove()
            _firstClickAddButton = true
        }
        _newTr.find('.is-valid').removeClass('is-valid')
        main.initSelect(_newTr.closest('tbody'))
        _newTr.find('select,input').prop('required', 1)
        _newTr.find('select').find('option:first').prop('selected', 1)
        _newTr.find('select').trigger('change')
        main.initInputmask(_newTr)
    }
</script>
@endpush