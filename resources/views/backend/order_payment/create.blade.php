@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">OrderPayment</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('order_payment.index') }}">OrderPayment</a></li>
                <li class="breadcrumb-item active" aria-current="page">OrderPayment Form</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form OrderPayment</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($order_payment) {{ route('order_payment.update', $order_payment->id) }} @endisset @empty($order_payment) {{ route('order_payment.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($order_payment)
                            @method('PUT')
                        @endisset
                        <div class='form-group'>
{!! Form::label('order_id', 'Relasi Order') !!}
{!! Form::text('order_id', isset($order_payment) ? $order_payment->order_id : @old('order_id'), [
                    'required',
                    'class' => 'form-control',
                    'placeholder' => 'Masukkan Relasi Order',
                ]) !!}</div>

<div class='form-group'>
{!! Form::label('value', 'Nominal') !!}
{!! Form::text('value', isset($order_payment) ? $order_payment->value : @old('value'), [
                    'required',
                    'class' => 'form-control',
                    'placeholder' => 'Masukkan Nominal',
                ]) !!}</div>

<div class='form-group'>
{!! Form::label('date', 'Tanggal') !!}
{!! Form::date('date', isset($order_payment) ? $order_payment->date : @old('date'), [
                    'required',
                    'class' => 'form-control',
                    'placeholder' => 'Masukkan Tanggal',
                ]) !!}</div>
                        <div class="text-end">
                            <a class="btn btn-warning" href="{{ route('order_payment.index') }}">Kembali</a>
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
