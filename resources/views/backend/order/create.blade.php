@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Order</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Form</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Order</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($order) {{ route('order.update', $order->id) }} @endisset @empty($order) {{ route('order.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($order)
                            @method('PUT')
                        @endisset
                        <div class='form-group'>
                            {!! Form::label('title', 'Judul') !!}
                            {!! Form::text('title', isset($order) ? $order->title : @old('title'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Judul',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('name', 'Nama Pemesan') !!}
                            {!! Form::text('name', isset($order) ? $order->name : @old('name'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Nama Pemesan',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('phone', 'Nomor HP') !!}
                            {!! Form::text('phone', isset($order) ? $order->phone : @old('phone'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Nomor HP',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('start_at', 'Tanggal Awal') !!}
                            {!! Form::date('start_at', isset($order) ? $order->start_at : @old('start_at'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Tanggal Awal',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('end_at', 'Tanggal Akhir') !!}
                            {!! Form::date('end_at', isset($order) ? $order->end_at : @old('end_at'), [
                                'required',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Tanggal Akhir',
                            ]) !!}</div>

                        <div class='form-group'>
                            {!! Form::label('description', 'Deskripsi Tambahan') !!}
                            {!! Form::textarea('description', isset($order) ? $order->description : @old('description'), [
                                'required',
                                'class' => 'form-control summernote',
                                'placeholder' => 'Masukkan Deskripsi Tambahan',
                            ]) !!}</div>
                        <div class="text-end">
                            <a class="btn btn-warning" href="{{ route('order.index') }}">Kembali</a>
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
