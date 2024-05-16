<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\StudentHelthRecord as StudentHelthRecordModel;
use Illuminate\Http\Request;

use Livewire\WithPagination;
class StudentHelthRecord extends Component
{
    use WithPagination;
    public $students_info_id;
    public $disease;
    public $date_of_injury;
    public $hereditary = "1";
    public $case_now;
    public $h_comments;
    public $register_date;
    public $students_info_ids  ;


    public $event ;
    public $updateId ;
    public $search = '';

    public $btnTitle = "اضافة";
    public $per_page = 10;

    public $getId;

    protected $rules = [
        'students_info_id' => 'required',
        'disease' => 'required',
        'date_of_injury' => 'required',
        'hereditary' => 'required',
        'case_now' => 'required',
        'h_comments' => 'required',
        'register_date' => 'required',
    ];
    protected $paginationTheme = 'bootstrap';

    public function render( Request $request )
    {

        $students = StudentHelthRecordModel::where('disease', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        $this->getId = $request->route('id');

        return view('livewire.admin.student-helth-record' , ['students' => $students]);


    }


    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function add(Request $request)
    {
        $idsd = $request->route('id');

        // $this->validate();

        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            StudentHelthRecordModel::create([
                'students_info_id' => $this->getId,
                'disease' => $this->disease,
                'date_of_injury' => $this->date_of_injury,
                'hereditary' => $this->hereditary,
                'case_now' => $this->case_now,
                'h_comments' => $this->h_comments,
                'register_date' => $this->register_date,
            ]);


            return redirect(route('helth.record' , $this->getId))->with('status', 'تمت الاضافة بنجاح');
        }

        $this->reset();
    }


    public function updateRec( $id)
    {


        $students = StudentHelthRecordModel::where('id', $id)->first();

        $this->students_info_id = $students->students_info_id;
        $this->disease = $students->disease;
        $this->date_of_injury = $students->date_of_injury;
        $this->hereditary = $students->hereditary;
        $this->case_now = $students->case_now;
        $this->h_comments = $students->h_comments;
        $this->register_date = $students->register_date;

        $this->updateId = $students->id;

        $this->btnTitle = "تعديل";

    }


    public function DoupdateRec($id )
    {


        $students = StudentHelthRecordModel::where('id', '=', $id)->first();

        $students->students_info_id = $this->students_info_id;
        $students->disease = $this->disease;
        $students->date_of_injury = $this->date_of_injury;
        $students->hereditary = $this->hereditary;
        $students->case_now = $this->case_now;
        $students->h_comments = $this->h_comments;
        $students->register_date = $this->register_date;

        $this->getId;
        $students->update();

        $this->btnTitle = "اضافة";
        $this->reset();
        // $this->dispatchBrowserEvent('hide-modal');
        return redirect(route('helth.record' , $students->students_info_id))->with('status', 'تمت التعديل بنجاح');
    }

    public function deleteRec(Request $request,$id)
    {

        $this->students_info_id = $request->route('id');
        StudentHelthRecordModel::where('id', '=', $id)->first()->delete();

        // $this->dispatchBrowserEvent('hide-modal');

        return redirect(route('helth.record' , $this->getId))->with('status', 'تمت الحذف بنجاح');
    }

}
