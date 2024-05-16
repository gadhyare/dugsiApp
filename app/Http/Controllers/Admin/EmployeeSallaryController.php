<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeSallaryController extends Controller
{
    public function index(){
        return  view('admin.finance.employee.salary') ;
    }




}
