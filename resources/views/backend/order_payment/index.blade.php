@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">OrderPayment</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('order_payment.index') }}">OrderPayment</a></li>
                <li class="breadcrumb-item active" aria-current="page">OrderPayment Tabel</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">OrderPayment</h3>
                </div>
                <div class="card-body">
                    <div class="text-end mb-2">
                        <a href="{{ route('order_payment.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table border table-bordered text-nowrap text-md-nowrap table-sm mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th>Relasi Order</th>
<th>Nominal</th>
<th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_payments as $order_payment)
                                    <tr>
                                        <td>{{$order_payment->order_id}}</td>
<td>{{$order_payment->value}}</td>
<td>{{$order_payment->date}}</td>
                                        <td class="text-center">
                                            <form action="{{ route('order_payment.destroy', $order_payment->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('order_payment.edit', $order_payment->id) }}">
                                                    Edit
                                                </a>
                                                <input type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')" value="Delete"
                                                    id="">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
