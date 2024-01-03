<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class InputEmail extends Component
{
    public $in_data;
    public function render()
    {
        return view('\livewire.common.input-email');
    }
    public function removeInput($id){
        $this->dispatch('removeInput',$id);
     }
}
