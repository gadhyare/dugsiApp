<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shifts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShiftsController extends Controller
{
    public function index()
    {
       
        return view('admin.shifts.index'  );
    }

    public function addFrm()
    {
        return view('admin.shifts.add');
    }

    public function add(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|unique:shifts|max:100',
            'active' => 'required',
        ]);

        $shifts = new Shifts();

        $shifts->name = $request->name;
        $shifts->active = $request->active;
        $shifts->save();


        return redirect(route('shifts.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }


    public function editFrm($id)
    {
        $level = Shifts::find($id)->first();
        return view('admin.shifts.edit'  , ['shifts' => $level , 'id' =>$id] );
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'name' => 'required|max:100',
            'active' => 'required',
        ]);

        $shifts = Shifts::find($id)->first();

        $shifts->name = $request->name;
        $shifts->active = $request->active;
        $shifts->update();


        return redirect(route('shifts.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }



    public function delete($id)
    {
         $level = Shifts::find($id)->first();

         $level->delete();

         return redirect(route('shifts.index'))->with('status' , 'تم الحذف');
    }
}
