<?php

namespace App\Http\Livewire\Admin\SchoolProgram;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Schoolprograms;
use Livewire\WithPagination;

class SchoolProgram extends Component
{  use WithPagination;
    public $heading = 'School Program';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    #[Rule('required')]
    public $name;
 

    public $isOpen = 0;
    public $isedit = 0;
    public $spId;
    public $universities;

    public function mount()
    {
        $this->universities = Schoolprograms::all();
    }
    public function clearFilters()
    {
        $this->searchTerm = null;
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
        $query = Schoolprograms::query();
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
        $this->reset('name','spId');
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
        Schoolprograms::create([
            'name' => $this->name
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('name');
             
    }
   

    public function edit($id)
        {
            $schoolprogram = Schoolprograms::findOrFail($id);
            $this->spId = $id;
            $this->name = $schoolprogram->name;
     
            $this->openModal();
        } 
        
        public function update()
        {
            $this->validate([
                'name' => 'required',
            ]);
        
            if ($this->spId) {
                $post = Schoolprograms::findOrFail($this->spId);
                $post->update([
                    'name' => $this->name,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name', 'spId');
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
        
        $schoolprograms = Schoolprograms::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','name');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $schoolprograms->orWhere('name','like',$searchQuery);
              
          }
          $schoolprogram = $schoolprograms->paginate(10);      
        
          return view('livewire.admin.schoolprogram.school-program',compact('schoolprogram'));
    }


    public function delete($spId)
    {
        $schoolprogram = Schoolprograms::findOrFail($spId);
        $schoolprogram->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
