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
                        <td>{{ $order->getStatus() }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-end mb-2">
            <a href="{{ route('order.generatePdf', $order->id) }}" target="_blank" class="btn btn-sm btn-danger">Export
                PDF</a>
            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Tambah Pesanan</button>
            @include('backend.order_detail.components.modalTambahPesanan')
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
                                <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $order_detail->id }}">Edit Pesanan</button>
                                @include('backend.order_detail.components.modalTambahPesanan')
                            </td>
                            <td>{{ $order_detail->qty }}</td>
                            <td>Rp. {{ number_format($order_detail->price) }} <br>
                                <div class="badge bg-primary">Rp. {{ number_format($order_detail->original_price) }}
                                </div>
                            </td>
                            <td>Rp. {{ number_format($order_detail->totalPrice()) }} <br>
                                <div class="badge bg-primary">Rp. {{ number_format($order_detail->totalRealPrice()) }}
                                </div>
                                <div class="badge bg-success">{{ number_format($order_detail->totalKeuntungan()) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-center">Total Harga</td>
                        <td>Rp. {{ number_format($order->totalPrice()) }} <br>
                            <div class="badge bg-primary">Rp. {{ number_format($order->totalRealPrice()) }}
                            </div>
                            <div class="badge bg-success">Rp. {{ number_format($order->totalUntung()) }}</div>
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
                                                        'oninput' => 'formatNumber(this)',
                                                    ]) !!}</div>
                                                <div class='form-group'>
                                                    {!! Form::label('real_value', 'Nominal Asli') !!}
                                                    {!! Form::text('real_value', isset($order_payment) ? $order_payment->real_value : @old('real_value'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Masukkan Nominal',
                                                        'oninput' => 'formatNumber(this)',
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
                                <div class="badge bg-success">{{ number_format($order_payment->real_value) }}</div>
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
                        <td>Rp. {{ number_format($order->totalPayment()) }}
                            <div class="badge bg-success">{{ number_format($order->totalRealPayment()) }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">Total Kekurangan</td>
                        <td>Rp. {{ number_format($order->totalKekurangan()) }}
                            <div class="badge bg-success">{{ number_format($order->totalRealKekurangan()) }}</div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row mt-2">

            <div class="col-md-6">
                <p>
                    {{ $order->title }} <br>
                    {{ $order->start_at }} s/d {{ $order->end_at }} <br><br>
                    @foreach ($order->order_details as $order_detail)
                        {{ $order_detail->name }} : {{ $order_detail->qty }}pcs x Rp.
                        {{ number_format($order_detail->price) }} =
                        Rp. {{ number_format($order_detail->totalPrice()) }}
                        <br>
                    @endforeach
                    <br>
                    Total : Rp. {{ number_format($order->totalPrice()) }} <br>
                    Sudah Dibayarkan : Rp. {{ number_format($order->totalPayment()) }} <br>
                    Total Kekurangan : Rp. {{ number_format($order->totalKekurangan()) }} <br>
                    Status : {{ $order->getStatus() }}
                </p>
                <p>
                    ============= ORIGINAL PRICE ================
                </p>
                <p>
                    {{ $order->title }} <br>
                    {{ $order->start_at }} s/d {{ $order->end_at }} <br><br>
                    @foreach ($order->order_details as $order_detail)
                        {{ $order_detail->name }} : {{ $order_detail->qty }}pcs x Rp.
                        {{ number_format($order_detail->original_price) }} =
                        Rp. {{ number_format($order_detail->totalRealPrice()) }}
                        <br>
                    @endforeach
                    <br>
                    Total : Rp. {{ number_format($order->totalRealPrice()) }} <br>
                    Sudah Dibayarkan : Rp. {{ number_format($order->totalRealPayment()) }} <br>
                    Total Kekurangan : Rp. {{ number_format($order->totalRealKekurangan()) }} <br>
                    Status : {{ $order->getStatus() }}
                </p>
            </div>
            <div class="col-md-6">
                @include('backend.order_file.create')
            </div>
        </div>

    </div>
</div>
@push('custom-scripts')
    <script>
        function formatNumber(input) {
            // Menghilangkan semua karakter kecuali angka dan tanda koma
            let value = input.value.replace(/[^0-9,]/g, '');

            // Menghapus tanda koma yang ada sebelum memformat
            value = value.replace(/,/g, '');

            // Memformat nilai dengan tanda koma
            value = Number(value).toLocaleString('en');

            // Mengatur nilai yang telah diformat kembali ke input
            input.value = value;
        }
    </script>
@endpush
