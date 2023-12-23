<?php

namespace App\Http\Livewire\Admin;
 
use Livewire\Component;
use Illuminate\Http\Request;
class AdminController extends Component
{

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('livewire.admin.layouts.app');
    }

}