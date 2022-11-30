<tr>
    <td>
        {!! Form::select('stock_adjustment_line[product_id][]', $productItems, $item->product_id ?? '' , ['class' => 'form-control select2', 'required' => 'required']) !!}
    </td>    
    <td>
        {!! Form::select('stock_adjustment_line[storage_location_id][]', $locationItems, $item->storage_location_id ?? '', ['class' => 'form-control select2', 'required' =>
    'required']) !!}
    </td>    
    <td>
        {!! Form::hidden('stock_adjustment_line[count_quantity][]', $item->count_quantity ?? '0', ['class' => 'form-control']) !!}
        {!! Form::text('stock_adjustment_line[onhand_quantity][]', $item->onhand_quantity ?? '', ['class' => 'form-control inputmask', 'data-unmask' => 1, 'data-optionmask' => json_encode(config('local.number.integer')),'required' =>
    'required']) !!}    
    </td>        
    <td>
        {!! Form::textarea('stock_adjustment_line[description][]', $item->description ?? '', ['class' => 'form-control', 'rows' => 2, 'cols' => 20, 'maxlength' => 256]) !!}
    </td>            
    <td>
        @if ($lastIndex)
            <button onclick="addRowSelect2(this)" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
        @endif
    </td>
</tr>