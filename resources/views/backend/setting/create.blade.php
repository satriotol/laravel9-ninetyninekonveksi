@extends('backend_layouts.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Setting</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('setting.index') }}">Setting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Setting Form</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Setting</h3>
                </div>
                <div class="card-body">
                    @include('partials.errors')
                    <form
                        action="@isset($setting) {{ route('setting.update', $setting->id) }} @endisset @empty($setting) {{ route('setting.store') }} @endempty"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @isset($setting)
                            @method('PUT')
                        @endisset
                        <div class='form-group'>
                            {!! Form::label('logo', 'Logo') !!}
                            {!! Form::text('logo', isset($setting) ? $setting->logo : @old('logo'), [
                                'required',
                                'class' => 'form-control upload-filepond',
                                'placeholder' => 'Masukkan Logo',
                            ]) !!}</div>
                        <div class="text-end">
                            <a class="btn btn-warning" href="{{ route('setting.index') }}">Kembali</a>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush
