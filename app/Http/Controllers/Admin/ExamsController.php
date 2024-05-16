<?php

namespace App\Http\Controllers\Admin;


use SystemInfo;
use App\Models\Exams;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Students_info;

class ExamsController extends Controller
{
    public function index($programs_id)
    {

        return view('admin.exams.index' , compact('programs_id'));
    }


    public function studentToPdf($students_info_id, $classes_id)
    {
        $student = Students_info::where('id', '=', $students_info_id)
            ->first();

        $exams = Exams::where('students_info_id', '=', $students_info_id)
            ->where('classes_id', '=', $classes_id)
            ->get();

        $exams_info = Exams::where('students_info_id', '=', $students_info_id)
            ->where('classes_id', '=', $classes_id)
            ->first();

        $filename = 'hello_world.pdf';


        // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);;

        // $html = View()->make('admin.exams.studentToPdf',   ['student' => $student, 'exams_info' => $exams_info, 'exams' => $exams])->render();



        // $pdf::SetFont('majalla');


        // $pdf::SetTitle('Hello World');
        // $pdf::AddPage();
        // $pdf::SetRTL(true);
        // $pdf::writeHTML($html, true, false, true, false, '');

        // $pdf::Output(public_path($filename), 'F');

        // return response()->download(public_path($filename));
    }
}
