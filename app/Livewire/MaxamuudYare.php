<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use App\Models\Students_info as Students_infoModel;

class MaxamuudYare extends Component
{


    use WithPagination;
    public $search = "";
    public $numberOfPaginatorsRendered;

    public $per_page = 10; 

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $searchText = $this->search;
        $students = Students_infoModel::whereHas('family_number', function($query) use($searchText) {
             $query->where( 'fnumber', 'LIKE', "%" . $searchText . "%");
        }) ->orWhere( DB::raw("concat(first_name , ' '  ,middle_name , ' ' , last_name)") , 'LIKE' , "%" . $this->search . "%"   )
           ->paginate($this->per_page);
        return view('livewire.maxamuud-yare' , compact('students'));
    }




    public function cancel(){
        $this->reset('search');
    }
}
