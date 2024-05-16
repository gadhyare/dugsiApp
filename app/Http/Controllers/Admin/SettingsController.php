<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SettingsController extends Controller
{
    public function index()
    {


        return view('admin.settings.index');
    }

    public function manageLogo()
    {


        return view('admin.settings.manage-logo');
    }


}
