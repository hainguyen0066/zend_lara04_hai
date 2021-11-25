@if (count($breadcrumbs))
    <div class="home">
        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{!! asset('news/images/footer.jpg') !!}" data-speed="0.8"></div>
        <div class="home_content_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="home_title">{{ $breadcrumbs->last()->title }}</div>
                            <div class="breadcrumbs">
                                <ul class="d-flex flex-row align-items-start justify-content-start">
                                    @foreach ($breadcrumbs as $breadcrumb)
                                        @if ($breadcrumb->url && !$loop->last)
                                            <li class=""><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                                        @else
                                            <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



