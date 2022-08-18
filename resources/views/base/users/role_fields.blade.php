        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Role</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                @php
                                    $userRole = isset($user) ? $user->roles()->pluck('role_id','role_id') : []; 
                                @endphp
                                @forelse ($roles as $item)                                                     
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="roles[]" @if(isset($userRole[$item->id])) checked @endif value="{{ $item->name }}" class="form-check-input">
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