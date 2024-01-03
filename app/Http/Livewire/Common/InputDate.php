<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class InputDate extends Component
{
    public $in_data;
    public function render()
    {
        return view('\livewire.common.input-date');
    }
    public function removeInput($id){
        $this->dispatch('removeInput',$id);
     }
}
