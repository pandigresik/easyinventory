@extends('layouts.app')

@section('content')
    @push('breadcrumb')
    <ol class="breadcrumb  my-0 ms-2">
        <li class="breadcrumb-item">@lang('models/stockMoveTypes.plural')</li>
    </ol>
    @endpush
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             @lang('models/stockMoveTypes.plural')
                             <a class="pull-right" href="{{ route('inventory.stockMoveTypes.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">                             
                             @include('inventory.stock_move_types.table')                             
                              <div class="pull-right mr-3">
                                     
                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

