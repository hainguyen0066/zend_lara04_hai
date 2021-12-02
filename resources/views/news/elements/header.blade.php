{{--@php--}}
{{--    use App\Models\CategoryModel as CategoryModel;--}}
{{--    use App\Helpers\URL;--}}

{{--    $categoryModel = new CategoryModel();--}}
{{--    $itemsCategory = $categoryModel->listItems(null, ['task' => 'news-list-items']);--}}

{{--    $xhtmlMenu = '';--}}
{{--    $xhtmlMenuMobile = '';--}}

{{--    if (count($itemsCategory) > 0) {--}}

{{--        $xhtmlMenu = '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';--}}
{{--        $xhtmlMenuMobile = '<nav class="menu_nav"><ul class="menu_mm">';--}}
{{--        $categoryIdCurrent = Route::input('category_id');--}}

{{--        foreach ($itemsCategory as $item) {--}}

{{--            $link       =  URL::linkCategory($item['id'], $item['name']);--}}
{{--            $classActive = ($categoryIdCurrent == $item['id']) ? 'class="active"' : '';--}}

{{--            $xhtmlMenu .= sprintf('<li %s><a href="%s">%s</a></li>', $classActive, $link, $item['name']);--}}
{{--            $xhtmlMenuMobile .= sprintf('<li class="menu_mm"><a href="%s">%s</a></li>', $link, $item['name']);--}}
{{--        }--}}

{{--        $xhtmlMenu .= sprintf('<li><a href="%s">Tin tức tổng hợp</a></li>', route('rss/index'));--}}
{{--        $xhtmlMenuMobile .= sprintf('<li class="menu_mm"><a href="%s">Tin tức tổng hợp</a></li>', route('rss/index'));--}}

{{--        if (session('userInfo')) {--}}
{{--            $xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/logout'), 'Logout');--}}
{{--        }else {--}}
{{--            $xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/login'), 'Login');--}}
{{--        }--}}

{{--        $xhtmlMenu .= $xhtmlMenuUser . '</ul></nav>';--}}
{{--        $xhtmlMenuMobile .= $xhtmlMenuUser . '</ul></nav>';--}}
{{--    }--}}

{{--@endphp--}}

@php
    $menus = \App\Models\MenuModel::where('status','active')->orderBy('order')->get();
    $categorys = \App\Models\CategoryModel::where([
        'status' => 'active',
        'parent_id' => 0
])->orderBy('order')->get();

@endphp

<header class="header">

    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{!! route('home') !!}">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image"
                                     style="background-image:url({{asset('news/images/zendvn-online.png') }});background-size: contain"></div>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">

                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>

                        <!-- Navigation -->
                        <ul class="list-menu">
                            @foreach($menus as $menu)
                                @if($menu->is_category == true)
                                    <li class="menu-item">
                                        <a target="{{ ($menu->type_open == 'current') ? '_self' : '_blank' }}"
                                           href="#">{{ $menu->name }}</a>
                                        <ul class="list-categorys">
                                            @foreach($categorys as $category)
                                                @if(count($category->childs) > 0)
                                                    <li class="category-item">
                                                        <a href="{{ route('category/index',[\Illuminate\Support\Str::slug($category->name), $category->id]) }}">
                                                            {{ $category->name }}
                                                        </a>
                                                        @foreach($category->childs as $child)
                                                            <ul class="list-category-child">
                                                                <li class="category-child">
                                                                    <a href="{{ route('category/index',[\Illuminate\Support\Str::slug($child->name), $child->id]) }}">{{ $child->name }}</a>
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                    </li>
                                                @else
                                                    <li class="category-item">
                                                        <a href="{{ route('category/index',[\Illuminate\Support\Str::slug($category->name), $category->id]) }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="menu-item">
                                        <a target="{{ ($menu->type_open == 'current') ? '_self' : '_blank' }}"
                                           href="{{ $menu->link }}">{{ $menu->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                                                  aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    .list-menu {
        margin-bottom: 10px;
        display: flex;
        height: 50px;

    }

    .list-menu li.menu-item {
        background-color: dodgerblue;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
        position: relative;
        margin: 0 20px;
    }

    .list-menu li a {
        color: #fff0ff;
        width: 100%;
        display: inline-block;
        padding: 15px;
    }

    .menu-item > .list-categorys {
        background-color: #fff0ff;
        padding: 0;
        position: absolute;
        top: 100%;
        left: 0;
        height: auto;
        display: none;
    }

    .menu-item:hover > .list-categorys {
        display: block;
    }

    .list-categorys li a {
        color: #000000;
    }

    .category-item {
        position: relative;
    }

    .category-item > .list-category-child {
        position: absolute;
        width: 100px;
        padding: 0;
        background: yellow;
        left: 100%;
        top: 0;
        display: none;
    }

    .category-item > .list-category-child a {
        padding: 20px;
        display: inline-block;
    }

    .category-item:hover > .list-category-child {
        display: block;
    }
</style>
