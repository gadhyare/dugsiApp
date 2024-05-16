<?php

use App\Models\Exams;
use App\Models\Invoices;
use App\Models\Settings;
use App\Models\FamilyNumber;
use App\Models\Employee_debt;
use App\Models\Students_info;
use App\Models\AdminPermission;
use App\Models\Employee_finance;
use App\Models\Employee_deduction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alkoumi\LaravelArabicNumbers\Numbers;
use App\Models\Permission;

class SystemInfo
{


    static public function setting(string $value)
    {
        $set = Settings::first();
        return $set->{$value} ?? '';
    }








    static function onesDigits($num): string
    {

        $number[0] = 'صفر';

        return $number[$num];
    }



    static function tensDigits($num): string
    {

        $number[10] = 'عشرة';

        return $number[$num];
    }



    static function numberToWord($num): string
    {
        $numToArray =   array_map('intval', str_split($num));


        $countNumber = count((array) $numToArray);



        if ($countNumber == 0) {
            $value = 0;
        }


        if ($countNumber == 1) {
            $value = self::onesDigits($num);
        }

        if ($countNumber == 2 && $numToArray[1] == 0) {
            $value = self::tensDigits($num);
        }

        return $value;
    }



    static public function get_current_student_previous_balance($stu_id, $id)
    {


        $totalOfWantForCurrentStudent =  DB::table('invoices')
            ->where('students_info_id', '=', $stu_id)
            ->where('invoices.id',  '<', $id)
            ->sum('want');

        $totalOfPaymentForCurrentStudent =  DB::table('fee_trans')
            ->where('invoices_id',  '<', $id)
            ->sum('amount');


        $totalOfDescountForCurrentStudent =  DB::table('fee_trans')
            ->where('invoices_id',  '<', $id)
            ->sum('descount');


        return $totalOfWantForCurrentStudent - $totalOfPaymentForCurrentStudent - $totalOfDescountForCurrentStudent ?? 0;
    }




    static public function get_full_student_name($id, $val = '')
    {
        $info =  Students_info::where('id', '=', $id)->first();
        if ($val == '') {
            return $info->first_name . ' ' . $info->middle_name . ' ' . $info->last_name;
        } else {
            return $info->$val;
        }
    }

    static public function get_familyNumber($id)
    {
        $info =  FamilyNumber::where('id', '=', $id)->first();
        return $info->fnumber;
    }

    static public function get_employee_finance($emp_id)
    {
        $info =  Employee_finance::where('employees_info_id', '=', $emp_id)->sum('amount');
        return $info;
    }



    static public function get_employee_net_sallary($emp_id, $billing_cycles_id)
    {
        $number =  $emp_id;
        $employees_debts = Employee_debt::where('employees_info_id', '=', $number)->where('billing_cycles_id', '=', $billing_cycles_id)->sum('amount');
        $employees_finances = Employee_finance::where('employees_info_id', '=', $number)->sum('amount');
        $employees_deductions = Employee_deduction::where('employees_info_id', '=', $number)->where('billing_cycles_id', '=', $billing_cycles_id)->sum('amount');
        $total =  $employees_finances - ($employees_debts + $employees_deductions);
        return $total;
    }



    static public function getMonthName($month)
    {
        $arr = [
            '01'  => 'يناير',
            '02'  => 'فبراير',
            '03'  => 'مارس',
            '04'  => 'إبريل',
            '05'  => 'مايو',
            '06'  => 'يونيو',
            '07'  => 'يوليو',
            '08' =>  'أغسطس',
            '09' =>  'سبتمبر',
            '10' =>  'أكتوبر',
            '11' =>  'نوفمبر',
            '12' =>  'ديسمبر',
        ];

        return  $arr[$month];
    }



    // static public function etExamTotal($stu_id, $pro_id){
    //     $totals = Exams::where('students_info_id' , '=' , $stu_id)->where('programs_id', '=' , $pro_id)->get()->sum();


    //     foreach ($totals as $total){

    //     }



    //     'qu1',
    //     'ex1',
    //     'qu2',
    //     'ex2',
    //     'att',
    // }


    static function tafqiidNumber($number)
    {
        return Numbers::TafqeetNumber($number);
    }




    static function getPastStudentFee($students_info_id, $programs_id, $feestypes_id, $billing_cycle_id)
    {
        $total = Invoices::leftJoin('fee_trans', 'fee_trans.invoices_id', '=', 'invoices.id')
            ->where('invoices.students_info_id', '=', $students_info_id)
            ->where('invoices.programs_id', '<', $programs_id)
            ->where('invoices.feestypes_id', '=', $feestypes_id)
            ->where('invoices.billing_cycles_id', '<', $billing_cycle_id)
            ->sum('fee_trans.amount');
        return $total;
    }



    static function adminHasPermission($admin_id, $permission_id): bool
    {

        $info = AdminPermission::where('admin_id', $admin_id)->where('permission_id', $permission_id)->first();

        if ($info) {
            return true;
        } else {
            return false;
        }
    }



    static function checkAdminAuth($name): bool
    {
    
        $info = AdminPermission::leftJoin('permission',    'admin_permissions.permission_id', '=', 'permission.id',)
            ->where('permission.name', '=', $name)
            ->where('admin_permissions.admin_id', '=', Auth::guard('admin')->user()->id)
            ->first();
        if ($info) {
            return true;
        } else {
            return abort( 403 ,'Not Allowed' );
        }
    }
}
