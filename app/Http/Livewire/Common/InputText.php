<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class InputText extends Component
{
    public $in_data;
    
    public function render()
    {
        return view('\livewire.common.input-text');
    }

    public function removeInput($id){
        $this->dispatch('removeInput',$id);
     }
}
