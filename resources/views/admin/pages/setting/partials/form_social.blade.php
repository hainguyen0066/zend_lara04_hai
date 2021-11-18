@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr      = config('zvn.template.form_input');
    $formLabelAttr      = config('zvn.template.form_label');
    $inputTaskHidden    = Form::hidden('setting-social', 'setting-social');

    $elements = [
         [
            'label'   => Form::label('facebook', 'Facebook', $formLabelAttr),
            'element' => Form::text('facebook', @$itemSocial['facebook'], $formInputAttr )
        ],
         [
            'label'   => Form::label('youtube', 'Youtube', $formLabelAttr),
            'element' => Form::text('youtube', @$itemSocial['youtube'], $formInputAttr)
        ],
          [
            'label'   => Form::label('google', 'Google', $formLabelAttr),
            'element' => Form::text('google', @$itemSocial['google'], $formInputAttr )
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
            @include('admin.templates.x_title', ['title' => 'Social'])
            <div class="x_content">
                {{ Form::open([
                    'method'         => 'POST',
                    'url'            => route("$controllerName/save-social"),
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
        var facebook     = document.querySelector('input[name=facebook]')
        var youtube      = document.querySelector('input[name=youtube]')
        var google       = document.querySelector('input[name=google]')
        tagifyFB         = new Tagify( facebook );
        tagifyYoutbe     = new Tagify( youtube );
        tagifyGoogle     = new Tagify( google );
    </script>
@endpush

