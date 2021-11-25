<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Str;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang Chủ', route('home'));
});

// Home > Chuyên Mục

Breadcrumbs::for('category', function ($trail, $category) {
    $categoryParent = \App\Models\CategoryModel::where('id', $category['parent_id'])->first();
    if ($categoryParent) {
        $trail->parent('category', $categoryParent);
    }else {
        $trail->parent('home');
    }
    $trail->push($category['name'], route('category/index',[
        Str::slug($category['name']),
        $category['id']
    ]));
});

// Home > Chuyên Mục > Bài Viết

Breadcrumbs::for('article', function ($trail, $article) {
    $category = \App\Models\CategoryModel::where('id', $article['category_id'])->first()->toArray();
    $trail->parent('category', $category);
    $trail->push($article['name'], route('article/index',[
        Str::slug($article['name']),
        $article['id']
    ]));
});



