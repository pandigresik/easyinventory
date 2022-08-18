@extends('layouts.app')

@section('content')
  <div class="container-fluid mt-3">
        <div class="animated fadeIn">
             @foreach ($widgets as $widget)
                 {!! $widget !!}
             @endforeach
        </div>
    </div>
</div>
@push('styles')
<link href="{{ asset('vendor/larapex-charts/apexcharts.css') }}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{ @asset('vendor/larapex-charts/apexcharts.js') }}"></script>
@endpush
@endsection
