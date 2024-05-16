<?php

namespace App\Http\Controllers\Admin;
use SystemInfo;
use App\Models\Levels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class levelsController extends Controller
{
    public function index()
    {

        $levels = Levels::orderby('id', 'DESC')->get();
        return view('admin.levels.index' , ['levels' => $levels]);
    }

    public function addFrm()
    {
        return view('admin.levels.add');
    }

    public function add(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|unique:levels|max:100',
            'active' => 'required',
        ]);

        $levels = new Levels();

        $levels->name = $request->name;
        $levels->active = $request->active;
        $levels->save();


        return redirect(route('levels.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }


    public function editFrm($id)
    {
        $level = Levels::find($id)->first();
        return view('admin.levels.edit'  , ['levels' => $level , 'id' =>$id] );
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'name' => 'required|max:100',
            'active' => 'required',
        ]);

        $levels = Levels::find($id)->first();

        $levels->name = $request->name;
        $levels->active = $request->active;
        $levels->update();


        return redirect(route('levels.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }



    public function delete($id)
    {
         $level = Levels::find($id)->first();

         $level->delete();

         return redirect(route('levels.index'))->with('status' , 'تم الحذف');
    }
}
