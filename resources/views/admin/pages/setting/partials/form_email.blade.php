@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr      = config('zvn.template.form_input');
    $formLabelAttr      = config('zvn.template.form_label');
    $inputTaskHidden    = Form::hidden('setting-email', 'setting-email');

    $elements = [
         [
            'label'   => Form::label('email', 'Email', $formLabelAttr),
            'element' => Form::text('email', @$itemEmail['email'], $formInputAttr )
        ],
         [
            'label'   => Form::label('password', 'Password', $formLabelAttr),
            'element' => Form::text('password', @$itemEmail['password'], $formInputAttr)
        ],
          [
            'label'   => Form::label('bcc', 'BCC', $formLabelAttr),
            'element' => Form::text('bcc', @$itemEmail['bcc'], $formInputAttr )
        ],
        [
            'element' => $inputTaskHidden . Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ],

    ];
@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Email'])
            <div class="x_content">
                {{ Form::open([
                    'method'         => 'POST',
                    'url'            => route("$controllerName/save-email"),
                    'accept-charset' => 'UTF-8',
                    'enctype'        => 'multipart/form-data',
                    'class'          => 'form-horizontal form-label-left',
                    'id'             => 'main-form-email' ])  }}
                {!! FormTemplate::show($elements)  !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@push('extra-script')
    <script>
        var bcc           = document.querySelector('input[name=bcc]')
        tagifyBcc         = new Tagify( bcc );
    </script>
@endpush

