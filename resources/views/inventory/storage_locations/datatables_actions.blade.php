{!! Form::open(['route' => ['inventory.storageLocations.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('inventory.qrcode') }}?data={{ $code }}" target="_blank" class='btn btn-ghost-success'>
        <i class="fa cil-qr-code"></i>
     </a>
    <a href="{{ route('inventory.storageLocations.show', $id) }}" class='btn btn-ghost-success'>
       <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('inventory.storageLocations.edit', $id) }}" class='btn btn-ghost-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
