<?php

namespace App\Http\Livewire\Admin\SchoolProgramType;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\SchoolProgramTypes;
use Livewire\WithPagination;

class SchoolProgramType extends Component
{
    use WithPagination;
    public $heading = 'School Program Type';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    #[Rule('required')]
    public $name;
 

    public $isOpen = 0;
    public $isedit = 0;
    public $sptId;
    public $universities;

    public function mount()
    {
        $this->universities = SchoolProgramTypes::all();
    }
    public function clearFilters()
    {
        $this->searchTerm = null;
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
        $query = SchoolProgramTypes::query();
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
        $this->reset('name','sptId');
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
        SchoolProgramTypes::create([
            'name' => $this->name
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('name');
             
    }
   

    public function edit($id)
        {
            $schoolprogramtype = SchoolProgramTypes::findOrFail($id);
            $this->sptId = $id;
            $this->name = $schoolprogramtype->name;
     
            $this->openModal();
        } 
        
        public function update()
        {
            $this->validate([
                'name' => 'required',
            ]);
        
            if ($this->sptId) {
                $post = SchoolProgramTypes::findOrFail($this->sptId);
                $post->update([
                    'name' => $this->name,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name', 'sptId');
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
        
        $schoolprogramtypes = SchoolProgramTypes::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','name');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $schoolprogramtypes->orWhere('name','like',$searchQuery);
              
          }
          $schoolprogramtype = $schoolprogramtypes->paginate(10);      
        
          return view('livewire.admin.schoolprogramtype.school-program-type',compact('schoolprogramtype'));
    }


    public function delete($sptId)
    {
        $schoolprogramtype = SchoolProgramTypes::findOrFail($sptId);
        $schoolprogramtype->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
