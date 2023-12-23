<?php

namespace App\Http\Livewire\Admin\PaymentTypeConfrence;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\paymenttypeconfrences;
use Livewire\WithPagination;

class PaymentTypeConfrence extends Component
{
     use WithPagination;
    public $heading = 'Payment Type Confrences';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';
    
    #[Rule('required')]
    public $name;
 
    #[Rule('required')]
    public $price;

    public $isOpen = 0;
    public $isedit = 0;
    public $ptcId;
    public $universities;
    public function mount()
    {
        $this->universities = paymenttypeconfrences::all();
    }
    public function clearFilters()
    {
        $this->searchTerm = null;
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
        $query = paymenttypeconfrences::query();
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
        $this->reset('name','price','ptcId');
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
        paymenttypeconfrences::create([
            'name' => $this->name,
            'price' => $this->price,
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('name','price');
             
    }
   

    public function edit($id)
        {
            $ptc = paymenttypeconfrences::findOrFail($id);
            $this->ptcId = $id;
            $this->name = $ptc->name;
            $this->price = $ptc->price;
     
            $this->openModal();
        } 

        public function update()
        {
            $this->validate([
                'name' => 'required',
                'price' => 'required',
            ]);
        
            if ($this->ptcId) {
                $post = paymenttypeconfrences::findOrFail($this->ptcId);
                $post->update([
                    'name' => $this->name,
                    'price' => $this->price,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name', 'price', 'ptcId');
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
        
        $ptc = paymenttypeconfrences::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','name','price');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $ptc->orWhere('name','like',$searchQuery);
               $ptc->orWhere('price','like',$searchQuery);
              
          }
          $ptcs = $ptc->paginate(10);  
        //   echo"<pre>";print_r($ptcs);die;    
        
          return view('livewire.admin.paymenttypeconfrence.payment-type-confrence',compact('ptcs'));
    }


    public function delete($ptcId)
    {
        $ptc = paymenttypeconfrences::findOrFail($ptcId);
        $ptc->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
