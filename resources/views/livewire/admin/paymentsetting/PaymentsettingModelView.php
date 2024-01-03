<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Paymentsetting;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PaymentsettingModelView extends Component
{
    // #[Validate('required')] 
    // public $name = '';
 
    // #[Validate('required')] 
    // public $field = '';


    public $isOpen;

    // public $heading = 'Add Payment Setting Field';

    // public function save()
    // {
    //     $this->validate(); 
    //     Paymentsetting::create(
    //         $this->only(['label','field'])
    //     );

    //     $this->dispatch('toastSuccess',$this->heading.' Create successfully saved.');
        
    //     return $this->redirect(route('admin.paymentsettings.paymentsettingcreate'), navigate: true);
    // }

    public function render()
    {
        return view('livewire.admin.paymentsetting.paymentsettingaddform');
    }

    // Add field model-form

        // public function create()
        // {       
        //     $this->reset('name');
        //     $this->openModal();
        // }
        public function openModal()
        {
        $this->isOpen = true;	
        $this->resetValidation();
            
        }
        public function closeModal()
        {
            $this->isOpen = false;
        }
  
    // public function store()
    // {         
    // $this->validate();
    // Paymentsetting::create([
    //     'name' => $this->name,
    //     // 'fields' => $this->fields,
    // ]);
    // $this->dispatch('toastSuccess',$this->heading.' create successfully .');
    
    // $this->closeModal();
    // $this->reset('name');
         
  }
   



