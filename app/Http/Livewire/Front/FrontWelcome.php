<?php

namespace App\Http\Livewire\Front;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class FrontWelcome extends Component
{
    
    public function render()
    {
        return view('livewire.front.front-welcome');
        
    }
}
