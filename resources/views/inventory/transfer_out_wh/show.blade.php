@extends('layouts.app')

@section('content')
     @push('breadcrumb')
        <ol class="breadcrumb  my-0 ms-2">
            <li class="breadcrumb-item">
                <a href="{{ route($baseRoute.'.index') }}">@lang('models/stockOutMoves.singular')</a>
            </li>
            <li class="breadcrumb-item active">@lang('crud.detail')</li>
        </ol>
     @endpush
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>@lang('crud.detail')</strong>
                                  <a href="{{ route($baseRoute.'.index') }}" class="btn btn-ghost-light">Back</a>
                             </div>
                             <div class="card-body">
                                 @include($baseView.'.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
