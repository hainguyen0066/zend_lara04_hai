<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    protected $pathViewController = 'admin.pages.filemanager.';

    public function index(Request $request)
    {
        return view($this->pathViewController . 'index');
    }
}
