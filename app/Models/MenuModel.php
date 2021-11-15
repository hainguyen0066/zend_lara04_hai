<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
class MenuModel extends AdminModel
{
    public function __construct() {
        $this->table               = 'menus';
        $this->folderUpload        = 'menu' ;
        $this->fieldSearchAccepted = ['id', 'name', 'link'];
        $this->crudNotAccepted     = ['_token', 'task'];
    }

    public function category() {
        return $this->hasMany('App\Models\CategoryModel', 'menu_id', 'id');
    }

    public function listItems($params = null, $options = null) {

        $result = null;

        if($options['task'] == "admin-list-items") {
            $query = $this->select('*');

            if ($params['filter']['status'] !== "all")  {
                $query->where('status', '=', $params['filter']['status'] );
            }

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                }
            }

            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }



        return $result;
    }

    public function countItems($params = null, $options  = null) {

        $result = null;

        if($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                        ->select( DB::raw('status , COUNT(id) as count') );

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                }
            }

            $result = $query->get()->toArray();


        }

        return $result;
    }

    public function getItem($params = null, $options = null) {
        $result = null;

        if($options['task'] == 'get-item') {
            $result = self::select('*')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'get-avatar') {
            $result = self::select('id', 'avatar')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'auth-login') {
            $result = self::select('id', 'menuname', 'fullname', 'email', 'level', 'avatar')
                    ->where('status', 'active')
                    ->where('email', $params['email'])
                    ->where('password', md5($params['password']) )->first();

            if($result) $result = $result->toArray();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null) {
        if($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status ]);
        }

        if($options['task'] == 'add-item') {
            $params['created_by'] = "hailan";
            $params['created']    = date('Y-m-d');
            self::insert($this->prepareParams($params));
        }

        if($options['task'] == 'edit-item') {

            $params['modified_by']   = "hailan";
            $params['modified']      = date('Y-m-d');
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

        if($options['task'] == 'change-level') {
            $level = $params['currentLevel'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }

        if($options['task'] == 'change-level-post') {
            $level = $params['level'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }

        if($options['task'] == 'change-password') {
            $password       = md5($params['password']);
            self::where('id', $params['id'])->update(['password' => $password]);
        }

        if($options['task'] == 'change-type-open') {
            self::where('id', $params['id'])->update(['type_open' => $params['currentType']]);
        }

        if($options['task'] == 'change-type-order') {
            self::where('id', $params['id'])->update(['order' => $params['order']]);
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }

}

