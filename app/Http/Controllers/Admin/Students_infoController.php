<?php

namespace App\Http\Controllers\Admin;

use App\Models\StudentsSchoolInfo;
use Illuminate\Http\Request;
use App\Exports\StudentsListExport;
use App\Http\Controllers\Controller;
use App\Models\Strurel;
use App\Models\StudentHelthRecord;
use App\Models\Students_info;
 
use App\Models\Groups;
use App\Models\Levels;
use App\Models\Shifts;
use App\Models\Classes;
use App\Models\Sections;

use App\Imports\StudentsInfoImport;
use Maatwebsite\Excel\Facades\Excel;



class Students_infoController extends Controller
{



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'levels_id' => 'required',
            'classes_id' => 'required',
            'shifts_id' => 'required',
            'groups_id' => 'required',
            'sections_id' => 'required', 
        ];
    }



    public function index()
    {
        return view('admin.students.info.index');
    }

    public function list( Request $request )
    {
        return view('admin.students.info.list' , ['programs_id' => $request->programs_id]);
    }
    public function upgrade($programs_id )
    {
        return view('admin.students.info.upgrade');
    }
    public function register($fat_id)
    {
        return view('admin.students.info.register');
    }

    public function helth_record()
    {
        return view('admin.students.helth.index');
    }
    public function school_record($stu_id)
    {
        return view('admin.students.school.index');
    }

    public function student_attachment($stu_id)
    {
        return view('admin.students.attachment.index');
    }

    public function exportToExcel(   )
    {
        return view('admin.students.attachment.index');
    }
    public function upload_list(  )
    {

        $levels = Levels::where('active', '=', '1')->orderBy('id', 'DESC')->get();
        $classes = Classes::where('active', '=', '1')->orderBy('id', 'DESC')->get();
        $shifts = Shifts::where('active', '=', '1')->orderBy('id', 'DESC')->get();
        $groups = Groups::where('active', '=', '1')->orderBy('id', 'DESC')->get();
        $sections = Sections::where('active', '=', '1')->orderBy('id', 'DESC')->get();
        return view('admin.students.info.upload-list' , ['levels' => $levels, 'sections' => $sections, 'shifts' => $shifts , 'classes' => $classes , 'groups' => $groups]);
    }


    public function upload_list_action(Request $request)
    {
        if($this->validate($request, $this->rules())){
            Excel::import(new StudentsInfoImport($request->levels_id, $request->classes_id, $request->groups_id, $request->sections_id, $request->shifts_id), $request->fileUpload); 

        }

    }


      public function printStudentInfo( $id  )
    {
        $students = Students_info::where('id' , '=' , $id)->first();
        $student_rels = Strurel::where('students_info_id' , '=' , $id)->get();
        $student_schools = StudentsSchoolInfo::where('students_info_id' , '=' , $id)->where('active', '=', '1')->first();
        $student_helths = StudentHelthRecord::where('students_info_id' , '=' , $id)->get();
        return view('admin.students.info.print-current-student', ['students' => $students , 'id' =>$id ,
                                                                    'student_rels' => $student_rels,
                                                                    'student_schools' => $student_schools,
                                                                    'student_helths' => $student_helths]) ;

    }




    public function download_student_simple_file(){
        $file = public_path()."download/students_empty_file.xlsx";
        return response()->download($file);
    }




}
