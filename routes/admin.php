<?php

use App\Livewire\Groups;
use App\Livewire\Levels;
use App\Livewire\Shifts;
use App\Livewire\Classes;

use App\Livewire\Sections;
use App\Livewire\Admin\Banks;
use App\Livewire\MaxamuudYare;
use App\Livewire\Admin\AdminLogin;
use App\Livewire\Admin\ClassPrograms;

use App\Livewire\Admin\GroupsTrashed;
use App\Livewire\Admin\LevelsTrashed;
use App\Livewire\Admin\ShiftsTrashed;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClassesTrashed;
use App\Livewire\Admin\SectionsTrashed;
use App\Livewire\Admin\Users\RoleIndex;
use App\Livewire\Admin\Users\TableLive;
use App\Livewire\Admin\Admin\AdminIndex;

use App\Livewire\Admin\Admin\UsersIndex;
use App\Livewire\Admin\Exams\AddToClass;
use App\Livewire\Admin\Exams\StudentExam;
use App\Livewire\Admin\FamilyNumber\Info;
use App\Livewire\Admin\Students\Register;

use App\Livewire\Admin\StudentSchoolInfo;
use App\Livewire\Admin\StudentsInfoUpdate;
use App\Livewire\Admin\Students\Attendance;
use App\Livewire\Admin\SubjectsDistribution;
use App\Livewire\Admin\Exams\ClassExamReport;
use App\Livewire\Admin\Students\UpgradeClass;
use App\Livewire\Admin\Users\AdminPermission;
use App\Livewire\Admin\Users\PermissionsLive;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BanksController;
use App\Http\Controllers\Admin\ExamsController;
use App\Livewire\Admin\FamilyNumber\FamilyInfo;
use App\Livewire\Admin\StudentsClassListUplaod;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\levelsController;
use App\Http\Controllers\Admin\ShiftsController;
use App\Livewire\Admin\FamilyNumber\InfoTrashed;
use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\StrurelController;
use App\Livewire\Admin\Students\AttendanceReport;
use App\Http\Controllers\Admin\FeesTypeController;
use App\Http\Controllers\Admin\SectionsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubjectsController;
use App\Livewire\Admin\Exams\ClassExamPrintReport;
use App\Http\Controllers\Admin\AllowanceController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\ExpensessController;
use App\Http\Controllers\Admin\StudentsFeeController;
use App\Livewire\Admin\Finance\Students\FeeClasstran;
use App\Http\Controllers\Admin\BillingCycleController;
use App\Http\Controllers\Admin\FamilyNumberController;
use App\Http\Controllers\Admin\FilesmanagerController;
use App\Livewire\Admin\Exams\StudentCurrentExamReport;
use App\Livewire\Admin\Students\AttendancePrintReport;
use App\Http\Controllers\Admin\Students_infoController;
use App\Http\Controllers\Admin\EmployeeSallaryController;
use App\Livewire\Admin\Exams\StudentCurrentExamReportPrint;
use App\Http\Controllers\Admin\AttendancePrintReportController;
use App\Http\Controllers\Admin\Fee\PrintSearchFeeBetweenTeoDate;
use App\Http\Controllers\Admin\Exams\ClassExamPrintReportController;
use App\Http\Controllers\Admin\Exams\ClassExamPrintReportControllerForSubject;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/login', AdminLogin::class)->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'login']);

Route::get('/admin/logout', [AdminController::class, 'getAdminLogout'])->name('admin.logout');
Route::post('/admin/logout', [AdminController::class, 'adminLogout']);

Route::group(['middleware' => 'AdminAuth'], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    Route::group(['prefix' => '/admin/users'], function () {
        Route::get('/',  function () {
            return view('admin.users.index');
        })->name('user.admin');


        Route::get('/admin',  AdminIndex::class)->name('user.admin');
        Route::get('/user',  UsersIndex::class)->name('user.user');
    });


    Route::group(['prefix' => '/admin/levels'], function () {
        Route::get('/',  Levels::class)->name('levels.index');
        Route::get('/trashed',  LevelsTrashed::class)->name('levels.trashed');
    });

    Route::group(['prefix' => '/admin/programs'], function () {
        Route::get('/', ClassPrograms::class)->name('programs.index');
    });


    Route::group(['prefix' => '/admin/classes'], function () {
        Route::get('/',  Classes::class )->name('classes.index');
        Route::get('/trashed',  ClassesTrashed::class)->name('classes.trashed'); 
    });


    Route::group(['prefix' => '/admin/groups'], function () {
        Route::get('/',  Groups::class)->name('groups.index');
        Route::get('/trashed',  GroupsTrashed::class)->name('groups.trashed');
    });


    Route::group(['prefix' => '/admin/shifts'], function () {
        Route::get('/',  Shifts::class )->name('shifts.index');
        Route::get('/trashed',  ShiftsTrashed::class)->name('shifts.trashed');

    });


    Route::group(['prefix' => '/admin/sections'], function () {
        Route::get('/', Sections::class  )->name('sections.index');
        Route::get('/trashed',  SectionsTrashed::class)->name('sections.trashed');
    });

    Route::group(['prefix' => '/admin/subjects'], function () {
        Route::get('/', [SubjectsController::class, 'index'])->name('subjects.index');
        Route::get('/distribution', SubjectsDistribution::class)->name('subjects.distribution');
    });

    Route::group(['prefix' => '/admin/banks'], function () {
        Route::get('/index', [BanksController::class, 'index'])->name('banks.index');
    });



    Route::group(['prefix' => '/admin/expenses'], function () {
        Route::get('/', [ExpensessController::class, 'index'])->name('expenses.index');
        Route::get('/type', [ExpensessController::class, 'type'])->name('expenses.type');
        Route::get('/feestype', [ExpensessController::class, 'index'])->name('expenses.feestype');
    });



    Route::group(['prefix' => '/admin/employee'], function () {
        Route::group(['prefix' => '/allowance'], function () {
            Route::get('/', [AllowanceController::class, 'index'])->name('allowance.index');
            Route::get('/type', [AllowanceController::class, 'type'])->name('allowance.type');
        });
        Route::group(['prefix' => '/sallary'], function () {
            Route::get('/', [EmployeeSallaryController::class, 'index'])->name('sallary.index');
        });


        Route::get('/debt', [EmployeesController::class, 'debt'])->name('employee.debt');
        Route::get('/deduction', [EmployeesController::class, 'deduction'])->name('employee.deduction');
    });


    Route::group(['prefix' => '/admin/finance/reports'], function () {
        Route::controller(BillingCycleController::class)->group(function () {
            Route::get('/',  'index')->name('finance.reports.index');
            Route::get('/by-billing-cycle',  'by_billing_cycle')->name('finance.reports.by-billing-cycle');
        });
    });



    Route::group(['prefix' => '/admin/fees'], function () {

        Route::controller(StudentsFeeController::class)->group(function () {

            Route::get('/',  'index')->name('fees.index');
            Route::get('/type',  'types')->name('fees.type');
            Route::get('/feesvalue',  'feesvalue')->name('fees.feesvalue');
            Route::get('/billing-cycle',  'billing_cycle')->name('fees.billing_cycle');
            Route::get('/fee-delete-for-class',  'feedelete_for_class')->name('fees.feedelete_for_class');
            Route::get('/fee-paid',  'feepaid')->name('fees.feepaid');
            Route::get('/fee-paid-tracking/{id}/{stu_id}',  'feepaidtracking')->name('fees.fee-paidtracking');
            Route::get('/fee-paid-tracking-pdf/{id}/{stu_id}',  'feepaidtracking_pdf')->name('fees.fee-paidtracking-pdf');
            Route::get('/fee-paid-tracking-pdfs/{id}/{stu_id}',  'pdfMake')->name('fees.fee-generate-pdf');
            Route::get('/fee-paid-pdf/{id}/{stu_id}',  'printStudentInfo')->name('fees.fee-paid-pdf');
            Route::get('/index-report', 'index_report')->name('fees.index-report');
            Route::get('/class-report', 'class_report')->name('fees.class-report');
            Route::get('/feeclasstran/{programs_id}', FeeClasstran::class)->name('fees.feeclasstran');
            Route::get('/print-fee-report-beteen-two-date/{from}/{to}', 'print_fee_report_beteen_two_date')->name('print.fee.report.beteen.two.date');;
            Route::get('/print-class-fee-report/{programs_id}/{feestypes_id}/{billing_cycle_id}', 'print_between_two_date_report_for_class')->name('print.fee.report.class');
            Route::get('/print-billing-cycle-report', 'print_billing_cycle_report')->name('print.billing.cycle.report');
        });
    });



    Route::group(['prefix' => '/admin/family-number'], function () {
        Route::get('/',  Info::class)->name('fnumber.index');
        Route::get('/trashed', InfoTrashed::class)->name('fnumber.trashed');
        Route::get('/family-info/{fnumber}',  FamilyInfo::class)->name('fnumber.info');
    });



    Route::group(['prefix' => '/admin/settings'], function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('/manage-logo', [SettingsController::class, 'manageLogo'])->name('settings.manage_logo');
    });

    Route::group(['prefix' => '/admin/filesmanager'], function () {
        Route::get('/', [FilesmanagerController::class, 'index'])->name('filesmanager.index');
    });



    Route::group(['prefix' => '/admin/students'], function () {
        Route::get('/info', [Students_infoController::class, 'index'])->name('students.info');
        Route::get('/current-student-update/{students}', StudentsInfoUpdate::class)->name('students.current.info.update');
        Route::get('/current-student-info-print/{id}', [Students_infoController::class, 'printStudentInfo'])->name('students.current.info.pdf');
        Route::get('/student-upgrade/{programs_id}',  UpgradeClass::class)->name('students.upgrade');
        Route::get('/student-list', [Students_infoController::class, 'list'])->name('students.list');
        Route::get('/student-list-export/{programs_id}', [Students_infoController::class, 'list'])->name('students.list.export');
        Route::get('/register/{family_number?}', Register::class)->name('students.register');
        Route::get('/strurel/{id}', [StrurelController::class, 'index'])->name('strurel.index');
        Route::get('/helth-record/{id}', [Students_infoController::class, 'helth_record'])->name('helth.record');
        Route::get('/school-record/{stu_id}', StudentSchoolInfo::class)->name('school.record');
        Route::get('/attachment/{stu_id}', [Students_infoController::class, 'student_attachment'])->name('student.attachment');
        Route::get('/upload-list/{programs_id}', StudentsClassListUplaod::class)->name('student.upload.list');
        Route::get('/attendance/{programs_id}', Attendance::class)->name('student.attendance');
        Route::get('/attendance/report/{programs_id}', AttendanceReport::class)->name('student.attendance.report');
        Route::get('/attendance/{programs_id}/print-report/{att_date}', [AttendancePrintReportController::class, 'index'])->name('student.attendance.print.report');
        Route::get('/download-student-simple-file', [Students_infoController::class, 'download_student_simple_file'])->name('download.student.simple.file');
    });



    Route::group(['prefix' => '/admin/employees'], function () {
        Route::get('/index', [EmployeesController::class, 'index'])->name('employees.index');
        Route::get('/info', [EmployeesController::class, 'info'])->name('employees.info');
        Route::get('/info/register', [EmployeesController::class, 'register'])->name('employees.register');
        Route::get('/info/update/{id}', [EmployeesController::class, 'update'])->name('employees.update');
        Route::get('/attachment/{emp_id}', [EmployeesController::class, 'attachments'])->name('employees.attachment');
        Route::get('/jobs/{emp_id}', [EmployeesController::class, 'jobs'])->name('employees.jobs');

        Route::get('/sections', [EmployeesController::class, 'sections'])->name('employees.sections');
        Route::get('/levels', [EmployeesController::class, 'levels'])->name('employees.levels');
        Route::get('/finance/{emp_id}', [EmployeesController::class, 'finance'])->name('employees.finance');
    });


    Route::group(['prefix' => '/admin/exams'], function () {
        Route::get('/index/{programs_id}', [ExamsController::class, 'index'])->name('exams.index');
        Route::get('/add-for-class/{programs_id}', AddToClass::class)->name('exams.add.for.class');
        Route::get('/add-for-students/{programs_id}', StudentExam::class)->name('exams.add.for.student');

        Route::group(['prefix' => 'report'], function () {
            Route::get('/add-for-class/{programs_id}', ClassExamReport::class)->name('exams.report.for.class');
            Route::get('/exam-for-class/{programs_id}', ClassExamPrintReportController::class)->name('exams.report.print.for.class');
            Route::get('/exam-for-class-for-subject/{programs_id}/{subjects_distributions_id}', ClassExamPrintReportControllerForSubject::class)->name('exams.report.print.for.class.for.subject');
            Route::get('/add-for-students/{programs_id}', StudentCurrentExamReport::class)->name('exams.report.for.student');
            Route::get('/add-for-students/print/{programs_id}/{students_info_id}', StudentCurrentExamReportPrint::class)->name('exams.report.for.student.print');
        });



        Route::get('/student/pdf/{students_info_id}/{classes_id}', [ExamsController::class, 'studentToPdf'])->name('exams.student.pdf');
    });



    Route::group(['prefix' => '/admin/permissions'], function () {


        Route::get('/tables',  TableLive::class)->name('permission.table.index');
        Route::get('/roles',  RoleIndex::class)->name('permission.role.index');
        Route::get('/admin-permission/{admin}',  AdminPermission::class)->name('permission.admin.permission.index');
    });


    Route::group(['prefix' => '/admin/yare'], function () {
        Route::get('/',  MaxamuudYare::class)->name('yare.index');
    });
});
