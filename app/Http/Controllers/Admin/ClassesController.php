<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;
use PDF;
class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::orderby('id', 'DESC')->get();
        return view('admin.classes.index' , ['classes' => $classes]);
    }

    public function addFrm()
    {
        return view('admin.classes.add');
    }

    public function add(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|unique:classes|max:100',
            'active' => 'required',
        ]);

        $classes = new Classes();

        $classes->name = $request->name;
        $classes->active = $request->active;
        $classes->save();


        return redirect(route('classes.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }


    public function editFrm($id)
    {
        $level = Classes::find($id)->first();
        return view('admin.classes.edit'  , ['classes' => $level , 'id' =>$id] );
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'name' => 'required|max:100',
            'active' => 'required',
        ]);

        $classes = Classes::find($id)->first();

        $classes->name = $request->name;
        $classes->active = $request->active;
        $classes->update();


        return redirect(route('classes.index' )  )->with('status'  ,  'تمت الإضافة بنجاح   ');
    }



    public function delete($id)
    {
         $level = Classes::find($id)->first();

         $level->delete();

         return redirect(route('classes.index'))->with('status' , 'تم الحذف');
    }



    public function print( )
    {

        $classes = Classes::orderby('id', 'DESC')->get();

		$pdf = PDF::loadView('admin.classes.print', ['classes' => $classes]);
		return $pdf->stream('document.pdf');

    }


}
