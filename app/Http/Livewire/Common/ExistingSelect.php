<?php

namespace App\http\Livewire\Common;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ExistingSelect extends Component
{

    public $in_data;
    // public $existingdata;

    public function render()
    {
        $existingdata = DB::table($this->in_data->existingSelect->table_name)->get();
        // echo "<pre>";print_r($existingdata);die;
// dd($existingdata);
        return view('livewire.common.existing-select',compact('existingdata'));
    }

    public function removeInput($id){
        $this->dispatch('removeInput',$id);
    }

   
}
