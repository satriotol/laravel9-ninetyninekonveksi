@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Detail Pemesanan</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('backend.order_detail.index')
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush
