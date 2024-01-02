<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class InputCheckbox extends Component
{
    public $in_data;
    public function render()
    {
        return view('\livewire.common.input-checkbox');
    }
    public function removeInput($id){
        $this->dispatch('removeInput',$id);
     }
}
