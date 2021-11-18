<?php

namespace App\Http\Controllers\News;
use App\Mail\ContactUser;
use App\Models\SettingModel;
use Illuminate\Http\Request;;
use Illuminate\Support\Facades\Mail;

class ContactController extends FrontController
{
    private $pathViewController = 'news.pages.contact.';  // slider
    private $controllerName     = 'contact';
    private $params             = [];

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request, SettingModel $settingModel)
    {
        $info = $settingModel->getItem(null, ['task' => 'get-setting-generate' ]);
        $email = $settingModel->getItem(null, ['task' => 'get-setting-email' ]);
        $breadCrumbName['name'] = 'Liên Hệ';

        return view($this->pathViewController .  'index',compact('info','email', 'breadCrumbName') );
    }

    public function sendMail(Request $request)
    {
        $details['name'] = $request->name;;
        $details['email'] = $request->email;
        $details['phone'] = $request->phone;
        $details['message'] = $request->message;;

        Mail::to('hainguyenhai0@gmail.com')->send(new ContactUser($details));

        return 'Email has been send';

    }


}
