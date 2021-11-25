@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $statusValue      = ['default' => 'Select status', 'active' => config('zvn.template.status.active.name'), 'inactive' => config('zvn.template.status.inactive.name')];
    $typeOpenValue    = ['default' => 'Select level', 'current' => 'Current', 'new_tab' => 'New-Tab'];
    $typeIsCategory  =  [ 0 => 'No', 1 => 'Yes'];


    $inputHiddenID    = Form::hidden('id', @$item['id']);
    $inputHiddenTask  = Form::hidden('task', 'add');

    $elements = [
        [
            'label'   => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', @$item['name'], $formInputAttr )
        ],[
            'label'   => Form::label('order', 'Order', $formLabelAttr),
            'element' => Form::number('order', @$item['order'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('status', 'Status', $formLabelAttr),
            'element' => Form::select('status', $statusValue, @$item['status'], $formInputAttr)
        ],
        [
            'label'   => Form::label('type_open', 'Type Open', $formLabelAttr),
            'element' => Form::select('type_open', $typeOpenValue, @$item['type_open'], $formInputAttr)
        ],
        [
            'label'   => Form::label('is_category', 'Is Category', $formLabelAttr),
            'element' => Form::select('is_category', $typeIsCategory, @$item['is_category'], $formInputAttr)
        ],
         [
            'label'   => Form::label('link', 'Link', $formLabelAttr),
            'element' => Form::text('link', @$item['link'], $formInputAttr )
        ],
        [
            'element' => $inputHiddenID . $inputHiddenTask . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ],
    ];
@endphp

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Form Add'])
            <div class="x_content">
                {{ Form::open([
                    'method'         => 'POST',
                    'url'            => route("$controllerName/save"),
                    'accept-charset' => 'UTF-8',
                    'enctype'        => 'multipart/form-data',
                    'class'          => 'form-horizontal form-label-left',
                    'id'             => 'main-form' ])  }}
                {!! FormTemplate::show($elements)  !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
