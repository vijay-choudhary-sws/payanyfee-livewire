<?php

namespace App\Http\Livewire\Front\Common;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class InputDate extends Component
{
    public $in_data;
    public $is_front;
 
    #[Modelable] 
    public $typedate;
     
    public function render()
    {
        return view('\livewire.front.common.input-date');
    }
}
