<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    protected function loginFrm(){
        if(! auth()->guard('admin')->check()){
            return view('admin.login');
        }else{
            return redirect(route('admin.dashboard'));
        }
    }


    protected function login(Request $request){
        $this->validate($request , [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->guard('admin')->attempt(['email' => $request->email , 'password' => $request->password])){
            return redirect(route('admin.login'));
        }else{
            return redirect(route('admin.dashboard'));
        }
    }



    protected function dashboard(){
         return view('admin.dashboard');
    }


    function getAdminLogout()
    {

        return redirect()->route('admin.logout');
    }

    function adminLogout(Request $request){
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }


}
