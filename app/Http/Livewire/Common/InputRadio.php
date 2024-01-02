<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class InputRadio extends Component
{
    public $in_data;
    public function render()
    {
        return view('\livewire.common.input-radio');
    }
    public function removeInput($id){
        $this->dispatch('removeInput',$id);
     }
}
