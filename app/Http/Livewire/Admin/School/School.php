<?php

namespace App\Http\Livewire\Admin\School;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Schools;
use Livewire\WithPagination;

class School extends Component
{  use WithPagination;
    public $heading = 'School';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    #[Rule('required')]
    public $name;
    public $isOpen = 0;
    public $isedit = 0;
    public $schoolId;
    
    public $universities;

    public function mount()
    {
        $this->universities = Schools::all();
    }
    public function clearFilters()
    {
        $this->searchTerm = null;
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
        $query = Schools::query();
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
        $this->reset('name','schoolId');
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
        Schools::create([
            'name' => $this->name,
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('name');
             
    }
   

    public function edit($id)
        {
            $school = Schools::findOrFail($id);
            $this->schoolId = $id;
            $this->name = $school->name;
            $this->openModal();
        } 

        public function update()
        {
            $this->validate([
                'name' => 'required',
            ]);
        
            if ($this->schoolId) {
                $post = Schools::findOrFail($this->schoolId);
                $post->update([
                    'name' => $this->name,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name','schoolId');
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
        
        $schools = Schools::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','name');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $schools->orWhere('name','like',$searchQuery);
              
          }
          $school = $schools->paginate(10);      
        
          return view('livewire.admin.school.school',compact('school'));
    }


    public function delete($schoolId)
    {
        $school = Schools::findOrFail($schoolId);
        $school->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
