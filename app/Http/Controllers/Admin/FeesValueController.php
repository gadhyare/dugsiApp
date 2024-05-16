<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeesValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FeesValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.finance.students.feesvalue');
    }




}
