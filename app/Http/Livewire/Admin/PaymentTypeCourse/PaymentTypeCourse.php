<?php

namespace App\Http\Livewire\Admin\PaymentTypeCourse;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Paymentypecourses;
use Livewire\WithPagination;

class PaymentTypeCourse extends Component
{ use WithPagination;
    public $heading = 'Payment Type Course';
    public $searchTerm = '';
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';

    #[Rule('required')]
    public $name;
 
    #[Rule('required')]
    public $course_id;

    public $isOpen = 0;
    public $isedit = 0;
    public $ptcId;

    public $universities;

    public function mount()
    {
        $this->universities = Paymentypecourses::all();
    }
    public function clearFilters()
    {
        $this->searchTerm = null;
        // Refresh the course list without filters
        $this->applyFilters();
    }
        
    public function applyFilters()
    {
        $query = Paymentypecourses::query();
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
        $this->reset('name','course_id','ptcId');
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
        Paymentypecourses::create([
            'name' => $this->name,
            'course_id' => $this->course_id,
        ]);
        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        
        $this->closeModal();
        $this->reset('name','course_id');
             
    }
   

    public function edit($id)
        {
            $pyc = Paymentypecourses::findOrFail($id);
            $this->ptcId = $id;
            $this->name = $pyc->name;
            $this->course_id = $pyc->course_id;
     
            $this->openModal();
        } 

        public function update()
        {
            $this->validate([
                'name' => 'required',
                'course_id' => 'required',
            ]);
        
            if ($this->ptcId) {
                $post = Paymentypecourses::findOrFail($this->ptcId);
                $post->update([
                    'name' => $this->name,
                    'course_id' => $this->course_id,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name', 'course_id', 'ptcId');
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
    // public function render()
    // {
        
    //     $pycs = Paymentypecourses::orderby($this->orderColumn,$this->sortOrder)
    //     ->select('id','name');
    //     $searchQuery = '%'.$this->searchTerm.'%';

    //       if(!empty($this->searchTerm)){
    //            $pycs->orWhere('name','like',$searchQuery);
              
    //       }
    //       $pycs = $pycs->paginate(10);      
        
    //       return view('livewire.admin.paymentypecourse.Paymen-type-courses',compact('pycs'));
    // }

    public function render()
    {
        
        $pycs = Paymentypecourses::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','name');
        $searchQuery = '%'.$this->searchTerm.'%';

          if(!empty($this->searchTerm)){
               $pycs->orWhere('name','like',$searchQuery);
              
          }
          $pycasz = $pycs->paginate(10);      
        
          return view('livewire.admin.paymenttypecourse.payment-type-courses',compact('pycasz'));
    }


    public function delete($ptcId)
    {
        $post = Paymentypecourses::findOrFail($ptcId);
        $post->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }
    
}
