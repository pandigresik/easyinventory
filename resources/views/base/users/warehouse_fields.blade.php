        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                @php
                                    $userWarehouse = isset($user) ? $user->warehouses()->pluck('warehouse_id','warehouse_id') : []; 
                                @endphp
                                @forelse ($warehouses as $item)                                                     
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="warehouses[]" @if(isset($userWarehouse[$item->id])) checked @endif value="{{ $item->id }}" class="form-check-input">
                                            {{ $item->name }}
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                @empty
                                    ----
                                @endforelse                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>