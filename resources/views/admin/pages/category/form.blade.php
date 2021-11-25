@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $dataMenus     = \App\Models\MenuModel::all()->pluck('name', 'id')->toArray();
    $parentCategory = \App\Models\CategoryModel::where('parent_id', 0)->get();
    $dataMenus[0]  = 'Select Menus';
    ksort($dataMenus);

    $parentCategory = \App\Models\CategoryModel::where('parent_id', 0)->pluck('id', 'name')->toArray();
    $parentCategory = array_flip($parentCategory);
    $parentCategory['0'] = 'Root';
    $parentCategory['Default'] = 'Select Parent category';

    ksort($parentCategory);
    $statusValue   = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];
    $inputHiddenID    = Form::hidden('id', @$item['id']);

    $elements = [
        [
            'label'   => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', @$item['name'], $formInputAttr )
        ],
        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
        ],
        [
            'element' => $inputHiddenID . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ],

    ];
@endphp

@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])
                <div class="x_content">
                    {{ Form::open([
                        'method'         => 'POST',
                        'url'            => route("$controllerName/save"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}
                        {!! FormTemplate::show($elements)  !!}
                        <div class="form-group">
                            <label>Chọn Category Cha</label>
                            <select class="form-control" name="parent_id" id="" >
                                <option value="0">Chọn Menu Cha</option>
                                {!! $categoryOptions !!}
                            </select>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
