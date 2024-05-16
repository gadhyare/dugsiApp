<?php

namespace App\Livewire\Admin;

use App\Models\Classes;
use App\Models\Levels;
use Livewire\Component;

use App\Models\FeesType;
use Livewire\WithPagination;
use App\Models\FeesValue as FeesValueModel;
use App\Models\Programs;

class FeesValue extends Component
{
    use WithPagination;
    public $amount;
    public $active = 1;

    public $feestypes_id;
    public $get_feestypes_id;

    public $updateId;
    public $programs_id;
    public $programs = [];

    public $btnTitle = "اضافة";

    public $levels = [];

    public $classes = [];
    public $showData = false;

    public $selectLevels;
    public $selectPrograms;
    public $search = '';

    public $per_page = 10;
    protected $rules = [
        'amount' => 'required', 
        'selectPrograms' => 'required',
        'feestypes_id' => 'required',
        'programs' => 'required',
    ];


    protected $paginationTheme = 'bootstrap';



    public function mount()
    {
        $this->programs = Programs::where('status', '1')->get();
    }


    public function render()
    {
        $feesValues = FeesValueModel::where('amount', 'like', '%' . $this->search . '%')->paginate($this->per_page);
        $feestypes = FeesType::where('active', '=', '1')->get();

        return view('livewire.admin.fees-value', ['feesValues' => $feesValues, 'feestypes' => $feestypes  ]);
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
            for($x = 0 ; $x < count($this->selectPrograms) ; $x++) {
                FeesValueModel::create([
                    'amount' => $this->amount, 
                    'programs_id' => $this->selectPrograms[$x],
                    'feestypes_id' => $this->feestypes_id,
                    'active' => $this->active,
                ]);
            }
 
            return redirect(route('fees.feesvalue'))->with('status', 'تمت الاضافة بنجاح');
        }

        $this->reset();
    }


    public function updateRec($id)
    {

        $feesValue = FeesValueModel::where('id',  '=', $id)->first();

        $this->amount = $feesValue->amount;
        $this->feestypes_id = $feesValue->feestypes_id;
        $this->active = $feesValue->active; 
        $this->updateId = $feesValue->id;
        $this->btnTitle = "تعديل";
    }


    public function DoupdateRec($id)
    {

        $feesValue = FeesValueModel::where('id', '=', $id)->first();

        $feesValue->amount = $this->amount;
        $feesValue->feestypes_id = $this->feestypes_id;
        $feesValue->active = $this->active;

        $feesValue->update();
        $this->btnTitle = "اضافة";
        $this->reset();
        // $this->dispatchBrowserEvent('hide-modal');
        return redirect(route('fees.feesvalue'))->with('status', 'تمت التعديل بنجاح');
    }

    public function deleteRec($id)
    {
        FeesValueModel::where('id', '=', $id)->first()->delete();
        // $this->dispatchBrowserEvent('hide-modal');
        return redirect(route('fees.feesvalue'))->with('status', 'تمت الحذف بنجاح');
    }



    public function getSelected()
    {
        $getInfo = FeesType::limit(1)->get();;
        return $getInfo[0]['id'];
    }

    public function gets_classes()
    {
        if($this->selectLevels !== '-1'){
            $this->classes  = Classes::where('levels_id',   $this->selectLevels )->get();
        }
    }


}
