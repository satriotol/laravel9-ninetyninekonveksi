@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">OrderDetail</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('order_detail.index') }}">OrderDetail</a></li>
                <li class="breadcrumb-item active" aria-current="page">OrderDetail Form</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form OrderDetail</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($order_detail) {{ route('order_detail.update', $order_detail->id) }} @endisset @empty($order_detail) {{ route('order_detail.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($order_detail)
                            @method('PUT')
                        @endisset
                        <div class='form-group'>
                            {!! Form::label('order_id', 'Order') !!}
                            {!! Form::text('order_id', isset($order_detail) ? $order_detail->order_id : @old('order_id'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Order',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('name', 'Jenis Pesanan') !!}
                            {!! Form::text('name', isset($order_detail) ? $order_detail->name : @old('name'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Jenis Pesanan',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('qty', 'Kuantitas') !!}
                            {!! Form::text('qty', isset($order_detail) ? $order_detail->qty : @old('qty'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Kuantitas',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('price', 'Harga') !!}
                            {!! Form::text('price', isset($order_detail) ? $order_detail->price : @old('price'), [
                                'required',
                                'class' => 'form-control money',
                                'placeholder' => 'Masukkan Harga',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('original_price', 'Harga Asli') !!}
                            {!! Form::text('original_price', isset($order_detail) ? $order_detail->original_price : @old('original_price'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Harga Asli',
                            ]) !!}</div>
                        <div class="text-end">
                            <a class="btn btn-warning" href="{{ route('order_detail.index') }}">Kembali</a>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush
