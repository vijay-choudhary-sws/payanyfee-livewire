<?php

namespace App\http\Livewire\Common;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ExistingSelect extends Component
{

    public $in_data;

    public function render()
    {
        $existingdata = $this->in_data->existingselect->posts;

        return view('livewire.common.existing-select',compact('existingdata'));
    }

    public function removeInput($id){
        $this->dispatch('removeInput',$id);
    }

   
}
