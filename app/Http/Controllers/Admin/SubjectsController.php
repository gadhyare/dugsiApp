<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subjects;
class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subjects::orderby('id', 'DESC')->get();
        return view('admin.subjects.index' , ['subjects' => $subjects]);
    }




    public function distribution()
    {
        $subjects = Subjects::orderby('id', 'DESC')->get();
        return view('admin.subjects.distribution' , ['subjects' => $subjects]);
    }





    public function addFrm()
    {
        return view('admin.subjects.add');
    }

    public function add(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|unique:subjects|max:100',
            'active' => 'required',
        ]);

        $subjects = new Subjects();

        $subjects->name = $request->name;
        $subjects->active = $request->active;
        $subjects->save();


        return redirect(route('subjects.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }


    public function editFrm($id)
    {
        $level = Subjects::find($id)->first();
        return view('admin.subjects.edit'  , ['subjects' => $level , 'id' =>$id] );
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'name' => 'required|max:100',
            'active' => 'required',
        ]);

        $subjects = Subjects::find($id)->first();

        $subjects->name = $request->name;
        $subjects->active = $request->active;
        $subjects->update();


        return redirect(route('subjects.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }



    public function delete($id)
    {
         $level = Subjects::find($id)->first();

         $level->delete();

         return redirect(route('subjects.index'))->with('status' , 'تم الحذف');
    }
}
