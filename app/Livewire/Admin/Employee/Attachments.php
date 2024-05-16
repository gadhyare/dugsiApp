<?php

namespace App\Livewire\Admin\Employee;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\EmployeesInfo;
use Livewire\WithFileUploads;
use App\Models\EmployeeAttachments as EmployeeAttachmentsModel;


class Attachments extends Component
{


    use WithPagination;

    use WithFileUploads;
    public $employees_info_id;
    public $title;
    public $description;
    public $file_name;


    public $emp_id;



    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $current_employee_info;

    public $per_page = 10;
    protected $rules = [
        'employees_info_id' => 'required',
        'title' => 'required',
        'description' => 'required',
        'file_name' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';



    public function mount( )
    {
         $this->employees_info_id = request('emp_id');
         $this->current_employee_info = EmployeesInfo::where('id' ,    $this->employees_info_id)->first();
    }




    public function render( )
    {
        $employyes_attachments = EmployeeAttachmentsModel::where('title', 'like', '%' . $this->search . '%')->paginate($this->per_page);

        return view('livewire.admin.employee.attachments', ['employyes_attachments' => $employyes_attachments ]);
    }


    public function updatedFile( )
    {
        $this->validate([
            'employees_info_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file_name' => 'required',
        ]);
    }


    public function add()
    {

        $this->validate();
        $fileName = time() . '-' . $this->file_name->getClientOriginalName();
        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            EmployeeAttachmentsModel::create([
                'employees_info_id' => $this->employees_info_id,
                'title' => $this->title,
                'description' => $this->description,
                'file_name' => $fileName,
            ]);

            return redirect(route('employees.attachment' , $this->employees_info_id  ))->with('status', 'تمت الاضافة بنجاح');
        }

        $this->file_name->store('/employee/attachments' );
        $this->reset();

        //$this->uploadFile($this->fileName);


        // $fileName = $this->file->getClientOriginalName();

        // $this->file = $fileName;
    }


    public function updateRec($id)
    {

        $employyes_attachments = EmployeeAttachmentsModel::where('id',   $id)->first();

        $this->employees_info_id = $employyes_attachments->employees_info_id;
        $this->title = $employyes_attachments->title;
        $this->description = $employyes_attachments->description;
        $this->file_name = $employyes_attachments->file_name;

        $this->updateId = $employyes_attachments->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {

        $employyes_attachments = EmployeeAttachmentsModel::where('id', '=', $id)->first();





        $employyes_attachments->employees_info_id = $this->employees_info_id;
        $employyes_attachments->title = $this->title;
        $employyes_attachments->description = $this->description;

        $fileName = time() . '-' . $this->file_name->getClientOriginalName();



        $employyes_attachments->file_name = $fileName;

        $employyes_attachments->update();


        $this->btnTitle = "اضافة";

        $this->file_name->store('/employee/attachments' );


        return redirect(route('employees.attachment' , $this->employees_info_id))->with('status', 'تمت التعديل بنجاح');

    }

    public function deleteRec($id)
    {
        EmployeeAttachmentsModel::where('id', '=', $id)->first()->delete();

        return redirect(route('employees.attachment' , $this->employees_info_id))->with('status', 'تمت الحذف بنجاح');
    }




}
