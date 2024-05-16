<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use PDF;
class FamilyNumberController extends Controller
{



    public function index()
    {
        return view('admin.family-number.index' );
    }



}
