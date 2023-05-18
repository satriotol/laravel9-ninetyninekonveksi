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
<div class="table-responsive">
    <table class="table border table-bordered text-nowrap text-md-nowrap table-sm mb-0">
        <thead>
            <tr class="text-center">
                <th>Data Dukung</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->order_files as $order_file)
                <tr>
                    <td><a href="{{ asset('uploads/' . $order_file->file) }}" target="_blank">Buka File</a></td>
                    <td class="text-center">
                        <form action="{{ route('order_file.destroy', $order_file->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a class="btn btn-sm btn-warning" href="{{ route('order_file.edit', $order_file->id) }}">
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
