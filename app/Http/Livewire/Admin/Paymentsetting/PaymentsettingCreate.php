<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\{InputType,Field,Inputselectdata,Paymentsetting};
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
    public $label;
    public $select_type;

    public $type_id = 1;
    public $inputType = false;
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

    public function gettagtype(){
    if($this->select_type == 'input'){
        $this->inputType = true;
    }else{

        $this->inputType = false;
    }
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
            ]);
    
            $this->slug = SlugService::createSlug(Paymentsetting::class, 'slug', $this->title);
    
           $lastinsertid = Paymentsetting::create(
                $this->only(['title', 'slug', 'email', 'cc_email', 'bcc_email', 'status'])
            )->id;

            $this->dispatch('toastSuccess', $this->heading.' Create successfully saved.');
    
            return $this->redirect(url('admin/paymentsettings/'.$lastinsertid.'/paymentsettingedit'), navigate: true);

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
        $Fields = Field::all();
        $Inputselectdata = Inputselectdata::all();
        $class="form-control";

        if(!empty($Fields)){
            return view('livewire.admin.paymentsetting.paymentsettingcreate',compact(['Fields','class','Inputselectdata'])); 
        }else{
            return view('livewire.admin.paymentsetting.paymentsettingcreate'); 
        }

    }

    public function Inputdelete($label, $select_type)
    {
        $fieldToDelete = Field::where([
            'label' => $label,
            'select_type' => $select_type,
        ])->first();
    
        if ($fieldToDelete) {
            $fieldToDelete->delete();
            $this->dispatch('toastSuccess', $fieldToDelete->label . ' successfully deleted.');
        } else {
            $this->dispatch('toastError', 'Field not found for deletion.');
        }
        
    }
    
    public function store()
    {   
        try {
          $validatedData = $this->validate([
            'label' => 'required',
            'select_type' => 'required',
        ]);
    
         Field::create([
            'label' => $this->label,
            'select_type' => $this->select_type,
            'type_id'=> $this->type_id,
        ]);

        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
         $this->close();
        $this->reset('label','select_type');
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



   
}


