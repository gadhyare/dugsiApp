<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sections;
class SectionsController extends Controller
{
    public function index()
    {
        $sections = Sections::orderby('id', 'DESC')->get();
        return view('admin.sections.index' , ['sections' => $sections]);
    }

    public function addFrm()
    {
        return view('admin.sections.add');
    }

    public function add(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|unique:sections|max:100',
            'active' => 'required',
        ]);

        $sections = new Sections();

        $sections->name = $request->name;
        $sections->active = $request->active;
        $sections->save();


        return redirect(route('sections.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }


    public function editFrm($id)
    {
        $level = Sections::find($id)->first();
        return view('admin.sections.edit'  , ['sections' => $level , 'id' =>$id] );
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'name' => 'required|max:100',
            'active' => 'required',
        ]);

        $sections = Sections::find($id)->first();

        $sections->name = $request->name;
        $sections->active = $request->active;
        $sections->update();


        return redirect(route('sections.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }



    public function delete($id)
    {
         $level = Sections::find($id)->first();

         $level->delete();

         return redirect(route('sections.index'))->with('status' , 'تم الحذف');
    }
}
