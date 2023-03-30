<form
    action="@isset($order_file) {{ route('order_file.update', $order_file->id) }} @endisset @empty($order_file) {{ route('order_file.store') }} @endempty"
    method="POST" enctype="multipart/form-data">
    @csrf
    @isset($order_file)
        @method('PUT')
    @endisset
    <div class='form-group d-none'>
        {!! Form::label('order_id', 'Order Id') !!}
        {!! Form::text('order_id', $order->id, ['class' => '']) !!}
    </div>

    <div class='form-group'>
        {!! Form::label('file', 'File') !!}
        {!! Form::file('files[]', ['class' => 'form-control upload-filepond', 'multiple']) !!}
    </div>
    <div class="text-end">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>
