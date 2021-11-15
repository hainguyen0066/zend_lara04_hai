<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\SliderModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private     $pathViewController = 'admin.pages.dashboard.';  // slider
    private     $controllerName     = 'dashboard';
    protected   $params = [];

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {

        $data = [
            [
                'total' => UserModel::count(),
                'name'  => 'User',
                'route' => 'user'
            ],
            [
                'total' => SliderModel::count(),
                'name'  => 'Slider',
                'route' => 'slider'
            ],
            [
                'total' => CategoryModel::count(),
                'name'  => 'Category',
                'route' => 'category'
            ],
            [
                'total' => ArticleModel::count(),
                'name'  => 'article',
                'route' => 'article'
            ],
        ];

        return view($this->pathViewController .  'index', compact('data'));
    }
}
