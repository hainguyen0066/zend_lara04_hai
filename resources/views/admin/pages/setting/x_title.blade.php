<div class="x_panel">
    <div class="x_content">
        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#setting-generate" role="tab" aria-controls="setting-generate" aria-selected="true">Cài Đặt Chung</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="setting-email-tab" data-toggle="tab" href="#setting-email" role="tab" aria-controls="setting-email" aria-selected="false">Emails</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active in" id="setting-generate" role="tabpanel" aria-labelledby="home-tab">
                @include('admin.pages.setting.partials.form_generate')
            </div>
            <div class="tab-pane fade" id="setting-email" role="tabpanel" aria-labelledby="setting-email-tab">
                @include('admin.pages.setting.partials.form_email')
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                @include('admin.pages.setting.partials.form_social')
            </div>
        </div>
    </div>
</div>
