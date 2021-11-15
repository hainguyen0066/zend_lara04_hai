@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Status</th>
                    <th class="column-title">Type Open</th>
                    <th class="column-title">Order</th>
                    <th class="column-title">Link</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index           = $key + 1;
                            $attrTypeOpen    = ['Current' => 'curent', 'New-Tab' => 'new_tab'];
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $display         = Template::showItemSelect($controllerName, $id, $val['type_open'], 'typeOpen',);
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']);
                            $order           = Template::showItemOrder($controllerName, $val['order'], $id, 'order');
                            $linkInputOrder  = route($controllerName . '/order', ['order' => 'value_new', 'id' => $id]);
                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created']);
                            $modifiedHistory = Template::showItemHistory($val['modified_by'], $val['modified']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="10%">{!! $name !!}</td>
                            <td width="5%">{!! $status!!}</td>
                            <td width="10%">{!! $display!!}</td>
                            <td width="5%">{!! Form::number('order_number', $val['order'], ['data-url' => $linkInputOrder, 'style'=>'text-align: center']); !!}</td>
                            <td width="10%"><a target="_blank" title="tab-menu" href="{{ $val['link'] }}">{{ $val['link'] }}</a></td>
                            <td >{!! $createdHistory !!}</td>
                            <td >{!! $modifiedHistory !!}</td>
                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>

