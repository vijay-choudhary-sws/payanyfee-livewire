<?php

namespace App\Http\Livewire\Front\Common;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class InputText extends Component
{
    public $in_data;
    public $is_front;
 
    #[Modelable] 
    public $typetext;

    public function render()
    {
        return view('\livewire.front.common.input-text');
    }
}
