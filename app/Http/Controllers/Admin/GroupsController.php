<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;
class GroupsController extends Controller
{
    public function index()
    {
        $groups = Groups::orderby('id', 'DESC')->get();
        return view('admin.groups.index' , ['groups' => $groups]);
    }

    public function addFrm()
    {
        return view('admin.groups.add');
    }

    public function add(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|unique:groups|max:100',
            'active' => 'required',
        ]);

        $groups = new Groups();

        $groups->name = $request->name;
        $groups->active = $request->active;
        $groups->save();


        return redirect(route('groups.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }


    public function editFrm($id)
    {
        $level = Groups::find($id)->first();
        return view('admin.groups.edit'  , ['groups' => $level , 'id' =>$id] );
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'name' => 'required|max:100',
            'active' => 'required',
        ]);

        $groups = Groups::find($id)->first();

        $groups->name = $request->name;
        $groups->active = $request->active;
        $groups->update();


        return redirect(route('groups.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }



    public function delete($id)
    {
         $level = Groups::find($id)->first();

         $level->delete();

         return redirect(route('groups.index'))->with('status' , 'تم الحذف');
    }
}
