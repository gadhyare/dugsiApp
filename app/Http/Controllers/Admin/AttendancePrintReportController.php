<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Programs;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\StudentsAttendance;
use App\Models\StudentsSchoolInfo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AttendancePrintReportController extends Controller
{




    function index (Request $request){
        $studentsInfos = StudentsSchoolInfo::with('studentInfo')->where('programs_id', '=', $request->programs_id)->get();
        if ($request->programs_id != null && $request->att_date && $request->att_date  != null) :
            $xuduurs = StudentsAttendance::where('programs_id', '=', $request->programs_id)->whereMonth('att_date', '=', date('m', strtotime($request->att_date)))->orderBy('att_date', 'asc')->get();
            $data_range = StudentsAttendance::query()->select(DB::raw('att_date'))->where('programs_id', '=', $request->programs_id)
                ->groupBy('att_date')->whereMonth('att_date', '=', date('m', strtotime($request->att_date)))->orderBy('att_date', 'asc')->get();
        else :
            $xuduurs = [];
        // $data_range = [];
        endif;

        $programs = Programs::where('id', '=',  $request->programs_id)->first()->program_name();

        $config = [
            'format' => 'A4-L' // Landscape
        ];


        $setting = Settings::first();


        $programs_id = $request->programs_id;
        // $hedaer_logo = public_path('images/small-logo-1710184443.png');

        // $pdf = Pdf::loadView('livewire.admin.students.attendance-print-report', compact('studentsInfos', 'xuduurs', 'data_range', 'programs' , 'setting', 'hedaer_logo' , 'programs_id'), [], $config);
        //     return $pdf->stream('invoice.pdf');

        // $pdf = Pdf::loadView('livewire.admin.students.attendance-print-report', compact('studentsInfos', 'xuduurs', 'data_range', 'setting', 'hedaer_logo'));
        return  view('livewire.admin.students.attendance-print-report', compact('studentsInfos', 'xuduurs', 'data_range', 'setting'));
        // return $pdf->download('invoice.pdf');
    }
}
