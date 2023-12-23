<?php

namespace App\Http\Livewire\Admin\StudentRegistration;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Studentregistrations;
use Livewire\WithPagination;

class StudentRegistration extends Component
{
    use WithPagination;
    public $heading = 'Student Registration';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    #[Rule('required')]
    public $name;
 

    public $isOpen = 0;
    public $isedit = 0;
    public $srId;
    public $universities;

    public function mount()
    {
        $this->universities = Studentregistrations::all();
    }
    public function clearFilters()
    {
        $this->searchTerm = null;
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
        $query = Studentregistrations::query();
        // Apply search term filter
        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }
        // Apply sorting
        $query->orderBy($this->orderColumn, $this->sortOrder);
        // Fetch filtered results
        $this->universities = $query->get();
    }
 
 
    public function create()
    {       
        $this->reset('name','srId');
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;	
    $this->resetValidation();
        
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
      

    public function store()
    {         
        $this->validate();
        Studentregistrations::create([
            'name' => $this->name
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('name');
             
    }
   

    public function edit($id)
        {
            $studentregistration = Studentregistrations::findOrFail($id);
            $this->srId = $id;
            $this->name = $studentregistration->name;
     
            $this->openModal();
        } 
        
        public function update()
        {
            $this->validate([
                'name' => 'required',
            ]);
        
            if ($this->srId) {
                $post = Studentregistrations::findOrFail($this->srId);
                $post->update([
                    'name' => $this->name,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name', 'srId');
            }
        }
        
    public function columnSortOrder($columnName=""){
        $caretOrder = "up";
        if($this->sortOrder == 'asc'){
             $this->sortOrder = 'desc';
             $caretOrder = "down";
        }else{
             $this->sortOrder = 'asc';
             $caretOrder = "up";
        } 
        $this->sortLink = '<i class="sorticon bx bx-caret-'.$caretOrder.'"></i>';
        $this->orderColumn = $columnName;
    }   
    public function render()
    {
        
        $studentregistration = Studentregistrations::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','name');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $studentregistration->orWhere('name','like',$searchQuery);
              
          }
          $studentregistrations = $studentregistration->paginate(10);      
        
          return view('livewire.admin.studentregistration.student-registration',compact('studentregistrations'));
    }


    public function delete($srId)
    {
        $studentregistration = Studentregistrations::findOrFail($srId);
        $studentregistration->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
