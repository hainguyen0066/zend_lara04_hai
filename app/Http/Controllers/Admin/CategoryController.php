<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CategoryRecusive;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;

class CategoryController extends Controller
{
    private $pathViewController = 'admin.pages.category.';
    private $controllerName     = 'category';
    protected $categoryRecusive;
    private $params             = [];
    private $model;

    public function __construct(CategoryRecusive $categoryRecusive)
    {
        $this->model = new MainModel();
        $this->categoryRecusive = $categoryRecusive;
        $this->params["pagination"]["totalItemsPerPage"] = 10;
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field']  = $request->input('search_field', ''); // all id description
        $this->params['search']['value']  = $request->input('search_value', '');

        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
        $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']); // [ ['status', 'count']]

        return view($this->pathViewController .  'index', [
            'params'        => $this->params,
            'items'         => $items,
            'itemsStatusCount' =>  $itemsStatusCount
        ]);
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
            $categoryOptions = $this->categoryRecusive->CategoryRecusiveEdit($item['parent_id']);
        } else {
            $categoryOptions = $this->categoryRecusive->CategoryRecusiveAdd();
        }

        return view($this->pathViewController .  'form', [
            'item'        => $item,
            'categoryOptions'  => $categoryOptions
        ]);
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = "add-item";
            $notify = "Th??m ph???n t??? th??nh c??ng!";

            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "C???p nh???t ph???n t??? th??nh c??ng!";
            }
            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }

    public function status(Request $request)
    {
        $params["currentStatus"]  = $request->status;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status']);
        $status = $request->status == 'active' ? 'inactive' : 'active';
        $link = route($this->controllerName . '/status', ['status' => $status, 'id' => $request->id]);
        return response()->json([
            'statusObj' => config('zvn.template.status')[$status],
            'link' => $link,
        ]);
    }

    public function isHome(Request $request)
    {
        $params["currentIsHome"]  = $request->is_home;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);
        $isHomeValue = $request->is_home == 'yes' ? 'no' : 'yes';
        $link = route($this->controllerName . '/isHome', ['is_home' => $isHomeValue, 'id' => $request->id]);
        return response()->json([
            'isHomeObj' => config('zvn.template.is_home')[$isHomeValue],
            'link' => $link,
        ]);
    }

    public function display(Request $request)
    {
        $params["currentDisplay"]   = $request->display;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-display']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function menu(Request $request)
    {
        $params["currentMenu"]   = $request->menu;
        $params["id"]            = $request->id;

        $this->model->saveItem($params, ['task' => 'change-menu']);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'X??a ph???n t??? th??nh c??ng!');
    }
}
