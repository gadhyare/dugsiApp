<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Students_info;
use Livewire\WithFileUploads;
use App\Models\StudentAttachments as StudentAttachmentsModel;

class StudentAttachments extends Component
{



    use WithPagination;

    use WithFileUploads;
    public $students_info_id;
    public $title;
    public $description;
    public $file_title;
    public $file;


    public $stu_id;



    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'students_info_id' => 'required',
        'title' => 'required',
        'description' => 'required',
        'file' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';



    public function mount( )
    {
         $this->stu_id = request('stu_id');
    }




    public function render(Request $request)
    {
        $students_attachments = StudentAttachmentsModel::where('title', 'like', '%' . $this->search . '%')->paginate($this->per_page);

        $ids = $request->route('id');
        $getStudent =Students_info::where('id' ,    $ids)->first();

        $this->students_info_id = $ids;

        return view('livewire.admin.student-attachments', ['students_attachments' => $students_attachments ,  'getStudent' => $getStudent ]);
    }


    public function updatedFile( )
    {
        $this->validate([
            'file' => 'required',
        ]);
    }


    public function add()
    {

        $this->validate();

        // if ($this->updateId) {
        //     $this->DoupdateRec($this->updateId);
        // } else {
        //     StudentAttachmentsModel::create([
        //         'students_info_id' => $this->stu_id,
        //         'title' => $this->title,
        //         'description' => $this->description,
        //         'file' => $this->file,
        //     ]);

        //     return redirect(route('students_attachments.index' , $this->stu_id))->with('status', 'تمت الاضافة بنجاح');
        // }

        // $this->reset();

        $this->uploadFile();


        // $fileName = $this->file->getClientOriginalName();

        // $this->file = $fileName;
    }


    public function updateRec($id)
    {

        $students_attachments = StudentAttachmentsModel::where('id',   $id)->first();

        $this->students_info_id = $students_attachments->students_info_id;
        $this->title = $students_attachments->title;
        $this->description = $students_attachments->description;
        $this->file = $students_attachments->file;

        $this->updateId = $students_attachments->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {

        $students_attachments = StudentAttachmentsModel::where('id', '=', $id)->first();

        $students_attachments->students_info_id = $this->students_info_id;
        $students_attachments->title = $this->title;
        $students_attachments->description = $this->description;
        $students_attachments->file = $this->file;

        $students_attachments->update();


        $this->btnTitle = "اضافة";


        $this->reset();

        return redirect(route('students_attachments.index' , $this->students_info_id))->with('status', 'تمت التعديل بنجاح');
    }

    public function deleteRec($id)
    {
        StudentAttachmentsModel::where('id', '=', $id)->first()->delete();

        return redirect(route('students_attachments.index' , $this->stu_id))->with('status', 'تمت الحذف بنجاح');
    }


    public function uploadFile()
    {



         StudentAttachmentsModel::create([
                    'students_info_id' => $this->stu_id,
                    'title' => $this->title,
                    'description' => $this->description,
                    'file_name' => $this->file->getClientOriginalName(),
                ]);

                
                $this->file->store('/attachments' , 'public');
         $this->reset();
    }


}

