@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    $formCkeditor  = config('zvn.template.form_ckeditor');

    $inputHiddenID     = Form::hidden('id', @$item['id']);
    $inputTaskHidden   = Form::hidden('setting-generate', 'setting-generate');
    $inputHiddenLogo   = Form::hidden('logo_current', @$item['logo']);
    $elements = [
        [
            'label'   => Form::label('logo', 'Logo', $formLabelAttr),
            'element' => Form::file('logo', $formInputAttr ),
            'avatar'   => (!empty(@$item['logo'])) ? Template::showItemThumb($controllerName, @$item['logo'], @$item['']) : null ,
            'type'    => "avatar"
        ],
         [
            'label'   => Form::label('hotline', 'Hotline', $formLabelAttr),
            'element' => Form::text('hotline', @$item['hotline'], $formInputAttr )
        ],
         [
            'label'   => Form::label('time_work', 'Thời Gian Làm Việc', $formLabelAttr),
            'element' => Form::text('time_work', @$item['time_work'], $formInputAttr )
        ],
         [
            'label'   => Form::label('copyright', 'CopyRight', $formLabelAttr),
            'element' => Form::text('copyright', @$item['copyright'], $formInputAttr )
        ],
         [
            'label'   => Form::label('address', 'Địa Chỉ', $formLabelAttr),
            'element' => Form::text('address', @$item['address'], $formInputAttr )
        ],
         [
            'label'   => Form::label('introduce', 'Giới Thiệu', $formLabelAttr),
            'element' => Form::textarea('introduce', @$item['introduce'], $formCkeditor)
        ],
          [
            'label'   => Form::label('googlemap', 'Google Map', $formLabelAttr),
            'element' => Form::textarea('googlemap', @$item['googlemap'], $formInputAttr )
        ],
        [
            'element' => $inputHiddenID. $inputHiddenLogo .$inputTaskHidden . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ],

    ];
@endphp

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Cài Đặt Chung'])
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
