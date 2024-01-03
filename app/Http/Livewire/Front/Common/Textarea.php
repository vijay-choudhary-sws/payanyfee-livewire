<?php

namespace App\Http\Livewire\Front\Common;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class Textarea extends Component
{
    public $in_data;
    public $is_front;

    #[Modelable] 
    public $typetextarea;

    public function render()
    {
        return view('\livewire.front.common.textarea');
    }
   
}

