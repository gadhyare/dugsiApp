<?php

namespace App\Http\Controllers\Admin\Exams;

use PDF;
use App\Models\Exams;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class ClassExamPrintReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $exams  = Exams::where('programs_id' , '=' , $request->programs_id)->groupBy('students_info_id')->get();

        //$subjects  = Exams::where('programs_id', '=', $request->programs_id)->get();
        $config = [
            'format' => 'A4-L', // Landscape

        ];

        $data =  Settings::first() ;

        $program_id = $request->programs_id;

        $hedaer_logo = public_path('images/small-logo-1710184443.png');
        $subjects = Exams::query()->select(DB::raw('subjects_distributions_id'))->where('programs_id', '=', $request->programs_id)
            ->groupBy('subjects_distributions_id')->get();
    // $pdf = Pdf::loadView("admin.exams.class-exam-print-report", compact('exams' , 'program_id' , 'subjects'  , 'data' , 'hedaer_logo'), [], $config);
    //     return $pdf->stream('invoice.pdf');
       return view("admin.exams.class-exam-print-report", compact('exams' , 'program_id' , 'subjects'  , 'data' , 'hedaer_logo'), [], $config);

    }
}
