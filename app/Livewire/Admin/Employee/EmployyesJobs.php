<?php


namespace App\Livewire\Admin\Employee;

use Livewire\Component;
use App\Models\Emsections;

use Livewire\WithPagination;
use App\Models\EmployeesInfo;
use Livewire\WithFileUploads;
use App\Models\EmplooyesLevels;
use App\Models\Employees_job as Employees_jobModel;


class EmployyesJobs extends Component
{


    use WithPagination;

    public $employees_info_id;
    public $emplooyes_levels_id;
    public $emsections_id;
    public $emsections;
    public $emplooyes_levels;
    public $salary;
    public $start_date;
    public $end_date;
    public $note;


    public $emp_id;



    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $current_employee_info;

    public $per_page = 10;
    protected $rules = [
        'employees_info_id' => 'required',
        'emplooyes_levels_id' => 'required',
        'emsections_id' => 'required',
        'salary' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'note' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';



    public function mount( )
    {
         $this->employees_info_id = request('emp_id');
         $this->current_employee_info = EmployeesInfo::where('id' ,    $this->employees_info_id)->first();

         $this->emsections = Emsections::where('active' ,  '=' ,  '1')->get();

         $this->emplooyes_levels = EmplooyesLevels::where('active' ,  '=' ,     '1')->get();
    }




    public function render( )
    {
        $employye_jobs = Employees_jobModel::paginate($this->per_page);

        return view('livewire.admin.employee.employyes-jobs', ['employye_jobs' => $employye_jobs ]);
    }


    public function updatedFile( )
    {
        $this->validate([
            'employees_info_id' => 'required',
            'emplooyes_levels_id' => 'required',
            'emsections_id' => 'required',
            'salary' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'note' => 'required',
        ]);
    }


    public function add()
    {

        $this->validate();

        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            Employees_jobModel::create([
                'employees_info_id' => $this->employees_info_id,
                'emplooyes_levels_id' => $this->emplooyes_levels_id,
                'emsections_id' => $this->emsections_id,
                'salary' => $this->salary,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'note' => $this->note,
            ]);

            return redirect(route('employees.jobs' , $this->employees_info_id  ))->with('status', 'تمت الاضافة بنجاح');
        }

        $this->reset();

        //$this->uploadFile($this->fileName);


        // $fileName = $this->file->getClientOriginalName();

        // $this->file = $fileName;
    }


    public function updateRec($id)
    {

        $employye_jobs = Employees_jobModel::where('id',   $id)->first();

        $this->employees_info_id = $employye_jobs->employees_info_id;
        $this->emplooyes_levels_id = $employye_jobs->emplooyes_levels_id;
        $this->emsections_id = $employye_jobs->emsections_id;
        $this->salary = $employye_jobs->salary;
        $this->start_date = $employye_jobs->start_date;
        $this->end_date = $employye_jobs->end_date;
        $this->note = $employye_jobs->note;


        $this->updateId = $employye_jobs->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {

        $employye_jobs = Employees_jobModel::where('id', '=', $id)->first();





        $employye_jobs->employees_info_id = $this->employees_info_id;
        $employye_jobs->emplooyes_levels_id = $this->emplooyes_levels_id;
        $employye_jobs->emsections_id = $this->emsections_id;
        $employye_jobs->salary = $this->salary;
        $employye_jobs->start_date = $this->start_date;
        $employye_jobs->end_date = $this->end_date;
        $employye_jobs->note = $this->note;


        $employye_jobs->update();


        $this->btnTitle = "اضافة";
        return redirect(route('employees.jobs' , $this->employees_info_id))->with('status', 'تمت التعديل بنجاح');

    }

    public function deleteRec($id)
    {
        Employees_jobModel::where('id', '=', $id)->first()->delete();

        return redirect(route('employees.jobs' , $this->employees_info_id))->with('status', 'تمت الحذف بنجاح');
    }





}
