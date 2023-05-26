<div class="modal fade" id="exampleModal{{ isset($order_detail) ? $order_detail->id : '' }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pemesanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        {!! Form::label('price', 'Harga /pcs') !!}
                        {!! Form::text('price', isset($order_detail) ? $order_detail->price : @old('price'), [
                            'required',
                            'class' => 'form-control',
                            'placeholder' => 'Masukkan Harga',
                            'oninput' => 'formatNumber(this)',
                        ]) !!}
                        <small class="text-danger">Harga Penjualan</small>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('original_price', 'Harga Asli /pcs') !!}
                        {!! Form::text('original_price', isset($order_detail) ? $order_detail->original_price : @old('original_price'), [
                            'required',
                            'class' => 'form-control',
                            'placeholder' => 'Masukkan Harga Asli',
                            'oninput' => 'formatNumber(this)',
                        ]) !!}
                        <small class="text-danger">Harga Reseller</small>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
