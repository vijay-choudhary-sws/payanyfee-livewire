<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Paymentsetting;
use App\Models\InputType;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\ValidationException;

class PaymentsettingCreate extends Component
{

    
    #[Validate('required')] 
    public $title = '';
 
    #[Validate('required')] 
    public $cc_email = '';

    #[Validate('required')] 
    public $bcc_email = '';

    #[Validate('required')] 
    public $email = '';

    // #[Validate('required')] 
    // public $input_fields = '';

    #[Validate('required')] 
    public $status = '';
    public $slug;
    public $isOpen;
    public $showAddFieldModal = false;
    public $fields;
    public $heading = 'Payment Setting';

    public function create()
    {
        $fields = InputType::all();
        $this->showAddFieldModal = true;
        $this->fields = $fields;
    }
    

    public function close()
    {
        $this->showAddFieldModal = false;
    }

    public function save()
    {
        try {
            $this->validate([
                'title' => 'required',
                'email' => 'required|email',
                'cc_email' => 'required|email',
                'bcc_email' => 'required|email',
                'status' => 'required',
                // Add more validation rules for other fields
            ]);
    
            $this->slug = SlugService::createSlug(Paymentsetting::class, 'slug', $this->title);
    
            Paymentsetting::create(
                $this->only(['title', 'slug', 'email', 'cc_email', 'bcc_email', 'status'])
            );
    
            $this->dispatch('toastSuccess', $this->heading.' Create successfully saved.');
    
            return $this->redirect(route('admin.paymentsettings'), navigate: true);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessages = [];
    
            foreach ($errors as $field => $messages) {
                $errorMessages[] = $field . ': ' . implode(', ', $messages);
            }
    
            $errorMessage = implode('<br>', $errorMessages);
    
            $this->dispatch('toastError', $errorMessage);
        } catch (\Exception $e) {
            $this->dispatch('toastError', 'An error occurred while processing your request.');
        }
    }
    
    
    public function render()
    {
        return view('livewire.admin.paymentsetting.paymentsettingcreate');
    }



   
}


