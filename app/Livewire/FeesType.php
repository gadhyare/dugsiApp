<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FeesType as FeesTypeModel;
class FeesType extends Component
{
    use WithPagination;
    public $name;
    public $active = 1;


    public $updateId;

    public $btnTitle = "اضافة";


    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'name' => 'required',
        'active' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $feestypes = FeesTypeModel::where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.fees-type', ['feestypes' => $feestypes]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function add()
    {

        $this->validate();

        if ($this->updateId) {
            $this->DoupdateRec($this->updateId);
        } else {
            FeesTypeModel::create([
                'name' => $this->name,
                'active' => $this->active,
            ]);

            return redirect(route('fees.type'))->with('status', 'تمت الاضافة بنجاح');
        }

        $this->reset();
    }


    public function updateRec($id)
    {

        $feestypes = FeesTypeModel::where('id',  '=', $id)->first();

        $this->name = $feestypes->name;
        $this->active = $feestypes->active;

        $this->updateId = $feestypes->id;
        $this->btnTitle = "تعديل";

    }


    public function DoupdateRec($id)
    {

        $feestypes = FeesTypeModel::where('id', '=', $id)->first();

        $feestypes->name = $this->name;
        $feestypes->active = $this->active;


        $feestypes->update();

        $this->btnTitle = "اضافة";
        $this->reset();
        // $this->dispatchBrowserEvent('hide-modal');
        return redirect(route('fees.type'))->with('status', 'تمت التعديل بنجاح');
    }

    public function deleteRec($id)
    {

        FeesTypeModel::where('id', '=', $id)->first()->delete();

        // $this->dispatchBrowserEvent('hide-modal');

        return redirect(route('fees.type'))->with('status', 'تمت الحذف بنجاح');
    }
}
