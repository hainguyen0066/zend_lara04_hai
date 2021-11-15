@extends('admin.main')

@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')
        <div class="row">
            @include('admin.pages.user.partial.form_change_password')
        </div>
@endsection
