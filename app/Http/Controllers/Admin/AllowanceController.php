<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllowanceController extends Controller
{

    public function index()
    {
        return view('admin.finance.allowance.index');
    }


    public function type()
    {
        return view('admin.finance.allowance.types.index');
    }




}
