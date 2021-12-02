<?php

namespace App\Helpers;

use App\Models\CategoryModel;

Class CategoryRecusive {

    private $html;
    protected $category;

    public function __construct(CategoryModel $categoryModel)
    {
        $this->html = '';
        $this->category = $categoryModel;
    }

    public function CategoryRecusiveAdd($parent_id = 0, $sub_mark = '')
    {
        $data = $this->category::where('parent_id',$parent_id)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option  value="'.$dataItem->id.'">'. $sub_mark . $dataItem->name .'</option>';
            $this->CategoryRecusiveAdd($dataItem->id,$sub_mark . '|--- ');
        }

        return $this->html;
    }

    public function CategoryRecusiveEdit($parentIdMenuedit, $parent_id = 0, $sub_mark = '')
    {
        $data = $this->category::where('parent_id',$parent_id)->get();
        foreach ($data as $dataItem) {
            if ($parentIdMenuedit == $dataItem->id){
                $this->html .= '<option selected value="'.$dataItem->id.'">'. $sub_mark . $dataItem->name .'</option>';
            }else{
                $this->html .= '<option  value="'.$dataItem->id.'">'. $sub_mark . $dataItem->name .'</option>';
            }
            $this->CategoryRecusiveEdit($parentIdMenuedit,$dataItem->id,$sub_mark . '|--- ');
        }

        return $this->html;
    }

    public static function menuRecusive($categorys)
    {
        $html = "<ul class='list-categorys'>";
        if ($categorys->childs) {
            foreach ($categorys->childs as $child) {
                $html .= "<li class='category-item'><a href=". route('category/index', [$child->name, $child->id]) ."></a></li>";
                if ($child->childs) {
                    self::menuRecusive($child);
                }
            }
        }

        $html .= "</ul>";

        return $html;

    }


}
