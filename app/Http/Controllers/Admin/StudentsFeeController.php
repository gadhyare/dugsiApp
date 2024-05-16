<?php

namespace App\Http\Controllers\Admin;


use SystemInfo;
use App\Models\User;
use App\Models\Banks;
use App\Models\FeeTrans;

use App\Models\Invoices;
use App\Models\BillingCycle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Exports\StudentsListExport;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use RealRashid\SweetAlert\Facades\Alert;

class StudentsFeeController extends Controller
{



    public function index()
    {
        return view('admin.finance.students.index');
    }


    public function types()
    {
        return view('admin.finance.students.type');
    }

    public function feesvalue()
    {
        return view('admin.finance.students.feesvalue');
    }

    public function feeclasstran()
    {

        $billings = BillingCycle::where('active', '=', 1)->get();

        if ($billings->count() > 1) {
            return redirect(route('fees.billing_cycle'))->with('message', 'وجود أكثر من دورة مالية مفعلة');
        }
        return view('admin.finance.students.feeclasstran');
    }

    public function billing_cycle()
    {

        return view('admin.finance.students.billing_cycle');
    }

    public function feepaid()
    {

        return view('admin.finance.students.feepaid');
    }

    public function feepaidtracking($id, $stu_id)
    {
        return view('admin.finance.students.fee-paid-tracking');
    }


    public function feepaidtracking_pdf($id, $stu_id)
    {


        $info = Invoices::where('id', '=', $id)->first();

        $invoiceTotal = Invoices::where('students_info_id', '=', $stu_id)->sum('want');

        $PaymentTotal = Invoices::join('fee_trans', 'invoice.id', '=', 'fee_trans.invoice_id')
            ->where('invoice.students_info_id',  '=', $stu_id)
            ->where('invoice.id',  '=', $id)
            ->sum('fee_trans.amount');


        $totalOfWantForCurrentStudent =  DB::table('invoice')
            ->where('students_info_id', '=', $stu_id)
            ->where('invoice.id',  '<=', $id)
            ->sum('want');

        $totalOfPaymentForCurrentStudent =  DB::table('fee_trans')
            ->where('students_info_id', '=', $stu_id)
            ->where('invoice_id',  '<=', $id)
            ->sum('amount');


        $totalOfDescountForCurrentStudent =  DB::table('fee_trans')
            ->where('students_info_id', '=', $stu_id)
            ->where('invoice_id',  '<=', $id)
            ->sum('descount');



        $totalOfPreviouBalanceForCurrentStudent =  DB::table('fee_trans')
            ->where('students_info_id', '=', $stu_id)
            ->where('invoice_id',  '<', $id)
            ->sum('descount');


        $previousBalance =  SystemInfo::get_current_student_previous_balance($stu_id, $id);

        FeeTrans::where('fee_trans.students_info_id', '=',  $stu_id)->where('fee_trans.invoice_id', '=',   $id)->get();



        $banks = Banks::where('active', '=', 1)->get();


        $feetrans = FeeTrans::where('invoice_id', '=', $id)->get();


        return view('admin.finance.students.feepaidtracking_pdf', [
            'ids' => $id, 'stu_id' => $stu_id, 'info' => $info,  'banks' => $banks,
            'feetrans' => $feetrans, 'invoiceTotal' => $invoiceTotal,
            'PaymentTotal' => $PaymentTotal,
            'totalOfWantForCurrentStudent' => $totalOfWantForCurrentStudent,
            'totalOfPaymentForCurrentStudent' => $totalOfPaymentForCurrentStudent,
            'totalOfDescountForCurrentStudent' => $totalOfDescountForCurrentStudent,
            'previousBalance' => $previousBalance
        ]);
    }

    public function pdfMake(int $id, int $stu_id)
    {


        $info = Invoices::where('id', '=', $id)->first();

        $invoiceTotal = Invoices::where('students_info_id', '=', $stu_id)->sum('want');

        $PaymentTotal = Invoices::join('fee_trans', 'invoice.id', '=', 'fee_trans.invoice_id')
            ->where('invoice.students_info_id',  '=', $stu_id)
            ->where('invoice.id',  '>', $id)
            ->sum('fee_trans.amount');


        $banks = Banks::where('active', '=', 1)->get();


        $feetrans = FeeTrans::where('invoice_id', '=', $id)->get();





        $invoices = Invoices::get();
        $data = [
            'title' => 'Asdff',
            'date' => date('m/d/Y'),
            'info' => $info
        ];



        $pdf = PDF::loadView('admin.finance.students.app', $data);
        return $pdf->stream('document.pdf');
    }



    public function index_report()
    {
        return view('admin.finance.students.reports.index');
    }

    public function class_report()
    {
        return view('admin.finance.students.reports.class_report');
    }



    public function get_current_student_previous_balance($stu_id, $id)
    {


        $totalOfWantForCurrentStudent =  DB::table('invoice')
            ->where('students_info_id', '=', $stu_id)
            ->where('invoice.id',  '<', $id)
            ->sum('want');

        $totalOfPaymentForCurrentStudent =  DB::table('fee_trans')
            ->where('students_info_id', '=', $stu_id)
            ->where('invoice_id',  '<', $id)
            ->sum('amount');


        $totalOfDescountForCurrentStudent =  DB::table('fee_trans')
            ->where('students_info_id', '=', $stu_id)
            ->where('invoice_id',  '<', $id)
            ->sum('descount');


        return $totalOfWantForCurrentStudent - $totalOfPaymentForCurrentStudent - $totalOfDescountForCurrentStudent ?? 0;
    }



    public function feedelete_for_class()
    {

        return view('admin.finance.students.feedelete_for_class');
    }



    public function print_fee_report_beteen_two_date($from, $to)
    {
        $feetrans = FeeTrans::wherebetween('paid_date', [$from, $to])->with('invoices')->get();
        $totalPaidBetweenTwoDate = FeeTrans::wherebetween('paid_date', [$from, $to])->sum('amount');

        $data = Settings::first();
        return view('admin.finance.students.print-between-two-date-report', compact('feetrans', 'from', 'to', 'totalPaidBetweenTwoDate', 'data'));
    }


    public function print_between_two_date_report_for_class($programs_id,  $feestypes_id, $billing_cycle_id)
    {


        $feetrans = Invoices::leftJoin('fee_trans', 'fee_trans.invoices_id', '=', 'invoices.id')
            ->where('invoices.programs_id', '=', $programs_id)
            ->where('invoices.feestypes_id', '=', $feestypes_id)
            ->where('invoices.billing_cycles_id', '=', $billing_cycle_id)
            ->get(['fee_trans.*', 'invoices.*']);


        $total = Invoices::leftJoin('fee_trans', 'fee_trans.invoices_id', '=', 'invoices.id')
            ->where('invoices.programs_id', '=', $programs_id)
            ->where('invoices.feestypes_id', '=', $feestypes_id)
            ->where('invoices.feestypes_id', '=', $feestypes_id)
            ->where('invoices.billing_cycles_id', '=', $billing_cycle_id)
            ->sum('fee_trans.amount');


        return view('admin.finance.students.print-class-fee-report', compact('feetrans', 'programs_id', 'feestypes_id',  'billing_cycle_id', 'total'));
    }


    public function print_billing_cycle_report( )
    {
  
        return view('admin.finance.reports.by-billing-cycle'  );
    }
}
