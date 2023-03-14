<div class="card">
    <div class="card-header">
        <h3 class="card-title">OrderDetail</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td>{{ $order->title }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pemesan</td>
                        <td>:</td>
                        <td>{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Hp</td>
                        <td>:</td>
                        <td class="text-wrap">{{ $order->phone }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{ $order->start_at }} s/d {{ $order->end_at }}</td>
                    </tr>
                    <tr>
                        <td>Marketing</td>
                        <td>:</td>
                        <td>{{ $order->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-end mb-2">
            <a href="{{ route('order.generatePdf', $order->id) }}" target="_blank" class="btn btn-sm btn-danger">Export
                PDF</a>
            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Tambah Pesanan</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pemesanan</h1>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_details as $order_detail)
                        <tr>
                            <td>{{ $order_detail->name }} <br>
                                <form action="{{ route('order_detail.destroy', $order_detail->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')" value="Delete" id="">
                                </form>
                            </td>
                            <td>{{ $order_detail->qty }}</td>
                            <td>Rp. {{ number_format($order_detail->price) }} <br>
                                <div class="badge bg-primary">Rp. {{ number_format($order_detail->original_price) }}
                                </div>
                            </td>
                            <td>Rp. {{ number_format($order_detail->totalPrice()) }} <br>
                                <div class="badge bg-primary">Rp. {{ number_format($order_detail->totalRealPrice()) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-center">Total Harga</td>
                        <td>Rp. {{ number_format($order->totalPrice()) }} <br>
                            <div class="badge bg-primary">Rp. {{ number_format($order->totalRealPrice()) }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-center">Histori Pembayaran
                            <button class="btn btn-sm btn-success" type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal2">Tambah Pembayaran</button>
                            <div class="modal fade" id="exampleModal2" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pembayaran</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <form
                                                action="@isset($order_payment) {{ route('order_payment.update', $order_payment->id) }} @endisset @empty($order_payment) {{ route('order_payment.store') }} @endempty"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @isset($order_payment)
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
                                                    <button class="btn btn-primary" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @foreach ($order->order_payments as $order_payment)
                                Rp. {{ number_format($order_payment->value) }}
                                <form action="{{ route('order_payment.destroy', $order_payment->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')" value="Delete" id="">
                                    <div class="badge bg-primary">
                                        {{ $order_payment->date }}
                                    </div>
                                </form>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">Total Pembayaran</td>
                        <td>Rp. {{ number_format($order->totalPayment()) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
