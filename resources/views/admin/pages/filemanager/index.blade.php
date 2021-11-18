@extends('admin.main')
    @php
        $url = asset('/file/dialog.php');
    @endphp
@section('content')
    <iframe src="{{ asset('/file/dialog.php') }}" frameborder="0" style="width: 100%; height: 500px; overflow-y: auto"></iframe>
@endsection

@push('extra-script')

@endpush




