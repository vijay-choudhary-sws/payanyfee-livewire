<?php

namespace App\http\Livewire\Front\Common;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Modelable;

class ExistingSelect extends Component
{
    public $in_data;
    public $is_front,$existingdata;


    #[Modelable] 
    public $typeselect;

    public function mount(){
    
        $this->existingdata = $this->in_data->existingselect->posts;
    }

    public function render()
    {
        return view('livewire.front.common.existing-select');
    }

    public function amountchange(){
        
        $this->dispatch('amountchangefront',id: $this->typeselect); 
    }

    					
    public function multipledataselect()
    {
        $this->dispatch('updatedSelectdata',id:$this->typeselect); 
       
    }

    
    
}
