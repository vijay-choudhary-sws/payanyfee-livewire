<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class Select extends Component
{
    public $in_data;

    public function render()
    {
        return view('livewire.common.select');
    }
    
    public function removeInput($id){
        $this->dispatch('removeInput',$id);
     }
}
