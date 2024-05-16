<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{



    public function index()
    {
        return view('admin.employees.index');
    }

    public function sections()
    {
        return view('admin.employees.sections');
    }


    public function levels()
    {
        return view('admin.employees.levels');
    }






    public function info()
    {
        return view('admin.employees.info');
    }

    public function register()
    {
        return view('admin.employees.register');
    }


    public function update($id)
    {
        return view('admin.employees.update');
    }




    public function attachments($emp_id)
    {
        return view('admin.employees.attachments');
    }

    public function jobs($emp_id)
    {
        return view('admin.employees.jobs');
    }

    public function finance($emp_id)
    {
        return view('admin.employees.finance');
    }

    public function debt( )
    {
        return view('admin.employees.debt');
    }

    public function deduction( )
    {
        return view('admin.employees.deduction');
    }

}
