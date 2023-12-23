<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class FrontWelcome extends Component
{

    public function tomain(){
        echo "hello";
        die;
    }
    public function render()
    {
        return view('livewire.front.front-welcome')
        ->layout('livewire.admin.layouts.applogin');
        
    }
}
