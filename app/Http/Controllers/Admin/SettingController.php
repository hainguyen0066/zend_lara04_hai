<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingModel as MainModel;
//use App\Http\Requests\SettingRequest as MainRequest;

class SettingController extends Controller
{
    private $pathViewController = 'admin.pages.setting.';
    private $controllerName     = 'setting';
    private $params             = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 10;
        view()->share('controllerName', $this->controllerName);
    }


    public function form(Request $request)
    {
        $item   = $this->model->getItem(null, ['task' => 'get-setting-generate']);
        $email  = $this->model->getItem(null, ['task' => 'get-setting-email']);
        $social = $this->model->getItem(null, ['task' => 'get-setting-social']);

        return view($this->pathViewController .  'form', [
            'item'  => $item,
            'itemEmail'  => $email,
            'itemSocial'  => $social
        ]);
    }

    public function save(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $notify = "Cập nhật Setting thành công!";
            $this->model->saveItem($params, ['task' => $params['setting-generate']]);

            return redirect()->route('dashboard')->with("zvn_notify", $notify);
        }
    }

    public function saveEmail(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $notify = "Cập nhật Setting thành công !";
            $this->model->saveItem($params, ['task' => $params['setting-email']]);

            return redirect()->route('dashboard')->with("zvn_notify", $notify);
        }
    }

    public function saveSocial(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $notify = "Cập nhật Setting thành công !";
            $this->model->saveItem($params, ['task' => $params['setting-social']]);

            return redirect()->route('dashboard')->with("zvn_notify", $notify);
        }
    }

}
