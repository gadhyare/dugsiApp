<?php

namespace App\Http\Controllers\Admin\Exams;

use PDF;
use App\Models\Exams;
use App\Models\Programs;
use App\Models\Settings;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClassExamPrintReportControllerForSubject extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $exams  = Exams::where('programs_id' , '=' , $request->programs_id)->where('subjects_distributions_id' , '=' , $request->subjects_distributions_id)->groupBy('students_info_id')->get();

        //$subjects  = Exams::where('programs_id', '=', $request->programs_id)->get();
        $config = [
            'format' => 'A4-L', // Landscape

        ];

        $data =  Settings::first() ;

        $program_id = $request->programs_id;

        $hedaer_logo =   Storage::url('app/public/images/'.$data->logo);
        $subjects = Exams::query()->select(DB::raw('subjects_distributions_id'))->where('programs_id', '=', $request->programs_id)
            ->groupBy('subjects_distributions_id')->get();
 

         

        return view("admin.exams.class-exam-print-report-for-subject", compact('exams' , 'program_id' , 'subjects'  , 'data' , 'hedaer_logo'  ), [], $config);
    
     

    }
}
