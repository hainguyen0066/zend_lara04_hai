@extends('news.main')
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb', ['item' => $breadCrumbName])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                @include('news.pages.contact.partials.info')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="h600 overflow-hidden" id="map-canvas">
                            @include('news.pages.contact.partials.googlemap')
                        </div>
                    </div>
                    <div class="col-lg-4 form_grid ml-7" style="margin-left: 50px" >
                        @include('news.pages.contact.partials.sendmail')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
