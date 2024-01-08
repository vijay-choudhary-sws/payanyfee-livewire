<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class SelectAmount extends Component
{
    public $in_data;

    public function render()
    {
        return view('livewire.common.select_amount');
    }
    
    public function removeInput($id){
        $this->dispatch('removeInput',$id);
    }
}
