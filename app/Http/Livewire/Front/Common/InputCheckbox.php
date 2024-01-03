<?php

namespace App\Http\Livewire\Front\Common;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class InputCheckbox extends Component
{
    public $in_data;
    public $is_front;
 
    #[Modelable] 
    public $typecheckbox ;

    public function render()
    {
        return view('\livewire.front.common.input-checkbox');
    }
}
