<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

class SettingModel extends AdminModel
{

    protected $settingKey = '';
    // attribute casting parse dữ liệu ra mong muốn
    protected $casts = [
        'value' => 'array',
    ];

    public function __construct()
    {
        $this->table               = 'setting';
        $this->folderUpload        = 'setting';
        $this->crudNotAccepted     = ['_token', 'setting-generate', 'setting-social', 'setting-email', 'logo_current', 'id'];
        $this->settingKey          = [
            'key' => 'key_value',
            'value' => 'value'
        ];

    }

    public function menus() {
        return $this->belongsTo('App\Models\MenuModel', 'menu_id');
    }

    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('*');

            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name')
                ->where('status', '=', 'active')
                ->limit(8);

            $result = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-is-home') {
            $query = $this->select('id', 'name', 'display')
                ->where('status', '=', 'active')
                ->where('is_home', '=', 'yes');

            $result = $query->get()->toArray();
        }

        if ($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                ->orderBy('name', 'asc')
                ->where('status', '=', 'active');

            $result = $query->pluck('name', 'id')->toArray();
        }
        return $result;
    }

    public function countItems($params = null, $options  = null)
    {

        $result = null;

        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'));

            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function getItem($params = null, $options = null)
    {

        if ($options['task'] == 'get-setting-generate') {
            $result = self::select('*')->where('key_value', 'setting-generate')->first();
            $result = $result->value;

            return $result;
        }

        if ($options['task'] == 'get-setting-email') {
            $result = self::select('*')->where('key_value', 'setting-email')->first();
            $result = $result->value;

            return $result;
        }

        if ($options['task'] == 'get-setting-social') {
            $result = self::select('*')->where('key_value', 'setting-social')->first();
            $result = $result->value;

            return $result;
        }

        return null;
    }

    public function saveItem($params = null, $options = null)
    {
        if (!empty($params)) {
            if ($options['task'] == 'setting-generate') {
                $key_value = $params['setting-generate'];
                if (!empty($params['logo'])) {
                    if (!empty($params['logo_current']) && !empty($params['logo'])) {
                        $this->deleteThumb($params['logo_current']);
                    }
                    $params['logo'] = $this->uploadThumb($params['logo']);
                } else {
                    $params['logo'] = $params['logo_current'];

                }
                $params = $this->prepareParams($params);
                self::where('key_value', $key_value)->update([
                    $this->settingKey['value'] => json_encode($params)
                ]);
            }

        if ($options['task'] == 'setting-email') {
            $key_value = $params['setting-email'];
            $params = $this->prepareParams($params);

            self::where('key_value', $key_value)->update([
                $this->settingKey['value'] => json_encode($params)
            ]);
        }

        if ($options['task'] == 'setting-social') {
            $key_value = $params['setting-social'];
            $params = $this->prepareParams($params);

            self::where('key_value', $key_value)->update([
                $this->settingKey['value'] => json_encode($params)
            ]);
        }
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
}
