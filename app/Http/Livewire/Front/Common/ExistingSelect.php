<?php

namespace App\http\Livewire\Front\Common;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Modelable;

class ExistingSelect extends Component
{
    public $in_data;
    public $is_front,$existingdata;


    #[Modelable] 
    public $typeselect;

    public function mount(){
        $this->existingdata = DB::table($this->in_data->existingSelect->table_name)->get();
    }

    public function render()
    {
        return view('livewire.front.common.existing-select');
    }
}
