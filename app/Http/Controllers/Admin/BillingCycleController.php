<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingCycleController extends Controller
{


    public function index(){
        return view('admin.finance.reports.index');
    }

    public function by_billing_cycle(){
        return view('admin.finance.reports.by-billing-cycle');
    }
}
