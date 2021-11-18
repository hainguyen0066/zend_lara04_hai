<?php

namespace App\Providers;

use App\Models\SettingModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settingModel = new SettingModel();
        $socialInfo = $settingModel->getItem(null, ['task' => 'get-setting-social']);
        View::share ( 'socialInfo', $socialInfo);
    }
}
