<?php

namespace App\Http\Livewire\Admin\Gst;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Gsts;
use Livewire\WithPagination;

class Gst extends Component
{
    use WithPagination;
    public $heading = 'Gst';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    #[Rule('required')]
    public $name;
 

    public $isOpen = 0;
    public $isedit = 0;
    public $gstId;
    public $universities;
    public function mount()
    {
        $this->universities = Gsts::all();
    }
    public function clearFilters()
    {
        $this->searchTerm = null;
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
        $query = Gsts::query();
        // Apply search term filter
        // if ($this->searchTerm) {
        //     $query->where('name', 'like', '%' . $this->searchTerm . '%');
        // }
        // // Apply sorting
        // $query->orderBy($this->orderColumn, $this->sortOrder);
        // Fetch filtered results
        $this->universities = $query->get();
    }
 
    public function create()
    {       
        $this->reset('name','gstId');
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
        Gsts::create([
            'name' => $this->name,
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('name');
             
    }
   

    public function edit($id)
        {
            $ptc = Gsts::findOrFail($id);
            $this->gstId = $id;
            $this->name = $ptc->name;
     
            $this->openModal();
        } 

        public function update()
        {
            $this->validate([
                'name' => 'required',
            ]);
        
            if ($this->gstId) {
                $post = Gsts::findOrFail($this->gstId);
                $post->update([
                    'name' => $this->name,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name', 'gstId');
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
        
        $gst = Gsts::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','name');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $gst->orWhere('name','like',$searchQuery);
              
          }
          $gsts = $gst->paginate(10);      
        
          return view('livewire.admin.gst.gst',compact('gsts'));
    }


    public function delete($gstId)
    {
        $gst = Gsts::findOrFail($gstId);
        $gst->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
