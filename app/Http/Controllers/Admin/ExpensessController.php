<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Expensess ;

class ExpensessController extends Controller
{

    public function index()
    {

        return view('admin.finance.expenses.index');
    }


    public function type()
    {

        return view('admin.finance.expenses.types.index');
    }
}
