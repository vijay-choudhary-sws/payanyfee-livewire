<?php

namespace App\http\Livewire\Front\Common;


use Livewire\Component;
use Livewire\Attributes\Modelable;

class SelectAmount extends Component
{

    public $in_data;
    public $is_front;

    #[Modelable] 
    public $typeselect;

    public function render()
    {
        return view('\livewire.front.common.select-amount');
    }

}