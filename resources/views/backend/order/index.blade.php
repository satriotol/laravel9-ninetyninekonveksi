@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Order</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Tabel</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order</h3>
                </div>
                <div class="card-body">
                    <div class="text-end mb-2">
                        <a href="{{ route('order.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table border table-bordered text-nowrap text-md-nowrap table-sm mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th>Marketing</th>
                                    <th>Judul</th>
                                    <th>Nama Pemesan</th>
                                    <th>Nomor HP</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-wrap">{{ $order->user->name }}</td>
                                        <td class="text-wrap">{{ $order->title }}</td>
                                        <td class="text-wrap">{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>
                                            <div class="badge bg-primary">{{ $order->start_at }}</div> s/d <div
                                                class="badge bg-primary">{{ $order->end_at }}</div>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('order.destroy', $order->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('order.show', $order->id) }}">
                                                    Detail
                                                </a>
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('order.edit', $order->id) }}">
                                                    Edit
                                                </a>
                                                <input type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')" value="Delete" id="">
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
