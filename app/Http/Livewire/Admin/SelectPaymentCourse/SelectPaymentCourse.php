<?php

namespace App\Http\Livewire\Admin\SelectPaymentCourse;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Selectpaymentcourses;
use Livewire\WithPagination;

class SelectPaymentCourse extends Component
{
    use WithPagination;
    public $heading = 'Select Payment Course';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    #[Rule('required')]
    public $name;
    public $isOpen = 0;
    public $isedit = 0;
    public $spcId;
    
    public $universities;
    public function mount()
    {
        $this->universities = Selectpaymentcourses::all();
    }

    public function clearFilters()
    {
        $this->searchTerm = null;
      
    
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
    
        $query = Selectpaymentcourses::query();
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
        $this->reset('name','spcId');
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
        Selectpaymentcourses::create([
            'name' => $this->name,
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('name');
             
    }
   

    public function edit($id)
        {
            $pyc = Selectpaymentcourses::findOrFail($id);
            $this->spcId = $id;
            $this->name = $pyc->name;
            $this->openModal();
        } 

        public function update()
        {
            $this->validate([
                'name' => 'required',
            ]);
        
            if ($this->spcId) {
                $post = Selectpaymentcourses::findOrFail($this->spcId);
                $post->update([
                    'name' => $this->name,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name','spcId');
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
        
        $spc = Selectpaymentcourses::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','name');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $spc->orWhere('name','like',$searchQuery);
              
          }
          $spcs = $spc->paginate(10);      
        
          return view('livewire.admin.selectpaymentcourse.select-payment-courses',compact('spcs'));
    }


    public function delete($spcId)
    {
        $post = Selectpaymentcourses::findOrFail($spcId);
        $post->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
