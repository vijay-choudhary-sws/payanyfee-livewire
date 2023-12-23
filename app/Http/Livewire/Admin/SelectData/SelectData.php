<?php

namespace App\Http\Livewire\Admin\SelectData;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\SelectDatas;
use Livewire\WithPagination;

class SelectData extends Component
{
    use WithPagination;
    public $heading = 'Select Data';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    #[Rule('required')]
    public $select_title;

    public $isOpen = 0;
    public $isedit = 0;
    public $sdId;
    public $universities;
    public function mount()
    {
        $this->universities = SelectDatas::all();
    }
    public function clearFilters()
    {
        $this->searchTerm = null;
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
        $query = SelectDatas::query();
        // Apply search term filter
        if ($this->searchTerm) {
            $query->where('select_title', 'like', '%' . $this->searchTerm . '%');
        }
        // Apply sorting
        $query->orderBy($this->orderColumn, $this->sortOrder);
        // Fetch filtered results
        $this->universities = $query->get();
    }
 
 
 
    public function create()
    {       
        $this->reset('select_title','sdId');
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
        SelectDatas::create([
            'select_title' => $this->select_title,
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('select_title');
             
    }
   

    public function edit($id)
        {
            $sd = SelectDatas::findOrFail($id);
            $this->sdId = $id;
            $this->select_title = $sd->select_title;
     
            $this->openModal();
        } 

        public function update()
        {
            $this->validate([
                'select_title' => 'required',
            ]);
        
            if ($this->sdId) {
                $post = SelectDatas::findOrFail($this->sdId);
                $post->update([
                    'select_title' => $this->select_title,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('select_title','sdId');
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
        
        $sd = SelectDatas::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','select_title');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $sd->orWhere('select_title','like',$searchQuery);
              
          }
          $selectdata = $sd->paginate(10);      
        
          return view('livewire.admin.selectdata.select-data',compact('selectdata'));
    }


    public function delete($sdId)
    {
        $selectdata = SelectDatas::findOrFail($sdId);
        $selectdata->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
