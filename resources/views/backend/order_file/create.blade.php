@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">OrderFile</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('order_file.index') }}">OrderFile</a></li>
                <li class="breadcrumb-item active" aria-current="page">OrderFile Form</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form OrderFile</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($order_file) {{ route('order_file.update', $order_file->id) }} @endisset @empty($order_file) {{ route('order_file.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($order_file)
                            @method('PUT')
                        @endisset
                        <div class='form-group'>
{!! Form::label('order_id', 'Order Id') !!}
{!! Form::select('order_id', '', isset($order_file) ? $order_file->order_id : @old('order_id'), [
                    'class' => 'form-control select2',
                    'required',
                    'placeholder' => 'Pilih Order Id'
                ]) !!}</div>

<div class='form-group'>
{!! Form::label('file', 'File') !!}
{!! Form::text('file', isset($order_file) ? $order_file->file : @old('file'), [
                    'required',
                    'class' => 'form-control',
                    'placeholder' => 'Masukkan File',
                ]) !!}</div>
                        <div class="text-end">
                            <a class="btn btn-warning" href="{{ route('order_file.index') }}">Kembali</a>
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
