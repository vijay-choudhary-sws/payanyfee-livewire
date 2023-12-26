<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\{Paymentsetting,InputType,Field,PaymentsettingMeta,Inputselectdata};
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\ValidationException;


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
    public $label;
    public $select_type;
    public $type_id = 1;


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
    
        $this->id = $paymentsettings->id;
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
    
        $this->validate([
            'title' => 'required',
            'email' => 'required',
            'cc_email' => 'required',
            'bcc_email' => 'required',
            'status' => 'required',
        ]);
    
        $this->slug = SlugService::createSlug(Paymentsetting::class, 'slug', $this->title);
     
        if ($this->id) {
            $post = Paymentsetting::findOrFail($this->id);
            $post->update([
                'title' => $this->title,
                'email' => $this->email,
                'cc_email' => $this->cc_email,
                'bcc_email' =>$this->bcc_email,
                'status' => $this->status,
            ]);

        
    
        $this->dispatch('toastSuccess', $this->heading . ' Update successfully updated.');
    
        return $this->redirect(route('admin.paymentsettings'), navigate: true);
        }
    }


    public function render()
    { 
        
        
        $paymentsetting_meta = PaymentsettingMeta::where('paymentsetting_id',$this->id)->get();
        //  echo"<pre>";print_r($paymentsetting_meta);die;
        $inputselectdatas = Inputselectdata::all();
        //  echo"<pre>";print_r($paymentsetting_meta);die;
        $Fields = Field::all();
        $class="form-control";
        if(!empty($Fields)){
            return view('livewire.admin.paymentsetting.Paymentsettingedit', compact('paymentsetting_meta','inputselectdatas','Fields','class'));
        }else{
            return view('livewire.admin.paymentsetting.Paymentsettingedit', compact('paymentsetting_meta','inputselectdatas','Fields','class'));
        }
    }

    public function Inputdelete()
    {
        // Assuming you want to delete a record based on the label and select type
        $fieldToDelete = PaymentsettingMeta::where('paymentsetting_id', $this->id)
            ->first();

           
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


    public function Inputdeletedg($label, $select_type)
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


 
    
    


    
    
}

