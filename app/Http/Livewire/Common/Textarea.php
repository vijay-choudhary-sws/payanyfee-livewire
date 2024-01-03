<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class Textarea extends Component
{
    public $in_data;
    public function render()
    {
        return view('livewire.common.textarea');
    }
    public function removeInput($id){
        $this->dispatch('removeInput',$id);
     }
}
