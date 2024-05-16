<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banks;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    public function index()
    {
        $banks = Banks::orderby('id', 'DESC')->get();
        return view('admin.banks.index' , ['banks' => $banks]);
    }
}
