<div class="card">
    <div class="card-header">
        <h3 class="card-title">OrderDetail</h3>
    </div>
    <div class="card-body">
        <div class="text-end mb-2">
            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Tambah</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <form
                                action="@isset($order_detail) {{ route('order_detail.update', $order_detail->id) }} @endisset @empty($order_detail) {{ route('order_detail.store') }} @endempty"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @isset($order_detail)
                                    @method('PUT')
                                @endisset
                                <div class='form-group d-none'>
                                    {!! Form::label('order_id', 'Order') !!}
                                    {!! Form::text('order_id', $order->id, [
                                        'required',
                                        'class' => 'form-control',
                                        'placeholder' => 'Masukkan Order',
                                    ]) !!}
                                </div>

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
                                        'class' => 'form-control',
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
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table border table-bordered text-nowrap text-md-nowrap table-sm mb-0">
                <thead>
                    <tr class="text-center">
                        <th>Jenis Pesanan</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_details as $order_detail)
                        <tr>
                            <td>{{ $order_detail->name }}</td>
                            <td>{{ $order_detail->qty }}</td>
                            <td>{{ number_format($order_detail->price) }} <br>
                                <div class="badge bg-primary">{{ number_format($order_detail->original_price) }}</div>
                            </td>
                            <td>{{ number_format($order_detail->totalPrice()) }}</td>
                            <td class="text-center">
                                <form action="{{ route('order_detail.destroy', $order_detail->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')" value="Delete" id="">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table">
                <tr>
                    <td>Total Harga</td>
                    <td>:</td>
                    <td>Rp. {{ $order->order_details }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
