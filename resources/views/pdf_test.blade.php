<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NINETYNINE KONVEKSI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        /* Atur lebar maksimum agar sesuai dengan lebar halaman PDF */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        /* Atur flex-basis untuk kolom agar rata */
        .col {
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
        }

        /* Atur margin agar ada jarak antara kolom */
        .col:not(:last-child) {
            margin-right: 15px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8pt;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <img src="{{ $imagePath }}" width="200" alt="">
    </div>
    <table class="mt-5">
        <tr>
            <th>Judul Artikel</th>
            <td>:</td>
            <td>{{ $order->title }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>:</td>
            <td>{{ $order->name }}</td>
        </tr>
        <tr>
            <th>Nomor HP</th>
            <td>:</td>
            <td>{{ $order->phone }}</td>
        </tr>
        <tr>
            <th>Timeline Pemesanan</th>
            <td>:</td>
            <td>{{ $order->start_at }} s/d {{ $order->end_at }}</td>
        </tr>
    </table>
    <table class="table table-sm table-bordered mt-3">
        <thead class="table-success">
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </thead>
        <tbody>

            @foreach ($order->order_details as $order_detail)
                <tr>
                    <td>{{ $order_detail->name }} <br>
                    </td>
                    <td>{{ $order_detail->qty }}</td>
                    <td>Rp. {{ number_format($order_detail->price) }} <br>
                    </td>
                    <td>Rp. {{ number_format($order_detail->totalPrice()) }} <br>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-center">Total Harga</td>
                <td>Rp. {{ number_format($order->totalPrice()) }} <br>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">Total Pembayaran</td>
                <td>Rp. {{ number_format($order->totalPayment()) }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">Total Kekurangan</td>
                <td>Rp. {{ number_format($order->totalKekurangan()) }}</td>
            </tr>
        </tbody>
    </table>
    <div style="margin-left:55%">
        Data Marketing
        <table>
            <tr>
                <th>Nama</th>
                <td>:</td>
                <td>{{ $order->user->name }}</td>
            </tr>
            <tr>
                <th>Nomor HP</th>
                <td>:</td>
                <td>{{ $order->user->phone }}</td>
            </tr>
        </table>
    </div>
    <div>
        <p>
            Untuk Pembayaran Anda Dapat Melalui <br>
            {{ $order->user->nama_bank }} <br>
            <b>{{ $order->user->nomor_bank }}</b> <br>
            Untuk Nominal DP 50% = <b> Rp. {{ number_format($order->totalPrice() / 2) }}</b>
        </p>
    </div>
    <div class="footer text-center">
        Di Cetak Pada Tanggal {{ $date }} <br>
        <a href="">{{ route('order.show', $order->id) }}</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
