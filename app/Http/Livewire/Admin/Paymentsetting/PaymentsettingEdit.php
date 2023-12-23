<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\{Paymentsetting,InputType};
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class PaymentsettingEdit extends Component
{
    #[Validate('required')] 
    public $title = '';
 
    #[Validate('required')] 
    public $slug = '';

    #[Validate('required')] 
    public $email = '';

    #[Validate('required')] 
    public $cc_email = '';

    #[Validate('required')] 
    public $bcc_email = '';

    #[Validate('required')] 
    public $status = '';
    public $id;
    public $Paymentsetting ;
    public $showEditModal = false;
    public $Editfields;
    public $heading = 'Paymentsetting';



    public function create()
    {
        $field = InputType::all();
        $this->showEditModal = true;
        $this->Editfields = $field;
    }
    

    public function close()
    {
        $this->showEditModal = false;
    }

    public function mount(Paymentsetting $paymentsettings)
    {
        $this->title = $paymentsettings->title;
        $this->slug = $paymentsettings->slug;
        $this->email = $paymentsettings->email;
        $this->cc_email = $paymentsettings->cc_email;
        $this->bcc_email = $paymentsettings->bcc_email;
        $this->status = $paymentsettings->status;
        $this->Paymentsetting = $paymentsettings;
       
    }

    public function update()
    {

        $this->validate(); 
        $this->slug = SlugService::createSlug(Paymentsetting::class, 'slug', $this->title);

        $this->Paymentsetting->fill(
            $this->only(['title', 'slug','email','cc_email','bcc_email','status'])
        )->save();

        $this->dispatch('toastSuccess',$this->heading.' Update successfully updated.');
        
        return $this->redirect(route('admin.paymentsettings'), navigate: true);
    }

    public function render()
    {

        return view('livewire.admin.paymentsetting.Paymentsettingedit');
    }

   
}

