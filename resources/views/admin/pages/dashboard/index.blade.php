

@extends('admin.main')
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Dashboard</h3>
        </div>
    </div>
    <div class="row">
       @if(!empty($data))
        <div class="col-md-12 col-sm-12 col-xs-12">
            @foreach($data as $widget)
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <div class="count">{{ $widget['total'] }}</div>
                    <h3>{{ $widget['name'] }}</h3>
                    <p><a href="{{ route($widget['route']) }}">Xem chi tiet!!!</a></p>
                </div>
            </div>
            @endforeach
        </div>
       @endif
    </div>
@endsection
