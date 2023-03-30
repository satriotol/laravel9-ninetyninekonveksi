@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">OrderFile</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('order_file.index') }}">OrderFile</a></li>
                <li class="breadcrumb-item active" aria-current="page">OrderFile Tabel</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">OrderFile</h3>
                </div>
                <div class="card-body">
                    <div class="text-end mb-2">
                        <a href="{{ route('order_file.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table border table-bordered text-nowrap text-md-nowrap table-sm mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th>Order Id</th>
<th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_files as $order_file)
                                    <tr>
                                        <td>{{$order_file->order_id}}</td>
<td>{{$order_file->file}}</td>
                                        <td class="text-center">
                                            <form action="{{ route('order_file.destroy', $order_file->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('order_file.edit', $order_file->id) }}">
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
                    {{ $order_files->appends($_GET)->links('pagination::bootstrap-5')->withClass('pagination-container') }}
                </div>
            </div>
        </div>
    </div>
@endsection
