<tr>
    <td>
        {!! Form::select('stock_move_line[product_id][]', $productItems, $item->product_id ?? '' , ['class' => 'form-control select2', 'required' => 'required']) !!}
    </td>
    <td>
        {!! Form::text('stock_move_line[lot_number][]', $item->lot_number ?? '' , ['class' => 'form-control', 'maxlength' => 20 ,'required' => 'required']) !!}
    </td>        
    <td>
        {!! Form::select('stock_move_line[storage_location_id][]', $locationItems, $item->storage_location_id ?? '', ['class' => 'form-control select2', 'required' =>
    'required']) !!}
    </td>
    <td>
        {!! Form::text('stock_move_line[quantity][]', $item->quantity ?? '', ['class' => 'form-control inputmask', 'data-unmask' => 1, 'data-optionmask' => json_encode(config('local.number.integer')),'required' =>
    'required']) !!}    
    </td>        
    <td>
        {!! Form::textarea('stock_move_line[description][]', $item->description ?? '', ['class' => 'form-control', 'rows' => 2, 'cols' => 20, 'maxlength' => 256]) !!}
    </td>            
    <td>
        @if ($lastIndex)
            <button onclick="addRowSelect2(this)" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
        @else
            <button onclick="main.removeRow(this)"  type="button" class="btn btn-primary btn-sm"><i class="fa fa-minus"></i></button>
        @endif        
    </td>
</tr>