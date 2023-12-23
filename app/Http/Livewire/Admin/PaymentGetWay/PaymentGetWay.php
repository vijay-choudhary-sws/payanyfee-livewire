<?php

namespace App\Http\Livewire\Admin\PaymentGetWay;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Paymentgetways;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Validation\ValidationException;

class PaymentGetWay extends Component
{
    use WithPagination;
     use WithFileUploads;
     use Exportable;
     
    public $heading = 'Payment GetWay';
    public $searchTerm;
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';
     
    #[Rule('required')]
    public $name;
 
    #[Rule('required')]
    public $selectpaymentcountry;

    #[Rule('required')]
    public $photo;

    
    #[Rule('required')]
    public $status;
    public $isOpen = 0;
    public $isedit = 0;
    public $pgwId;
    public $selectedtitle;
    public $filterApplied = false;
    public $clearfilter = "";
    public function mount()
    {
        $this->Payments= Paymentgetways::all();
    }
    public function applyFilter()
    {
        $this->filterApplied = true;
    }

    public function clearFilter()
    {
        $this->selectedtitle = '';
        $this->search = '';
        $this->status = '';
        $this->filterApplied = false;
    }



    public function exportToExcel()
    {
        return Excel::download(new \App\Exports\YourExportClass, 'exported_data.xlsx');
    }
    
    public function query()
    {
        // Your query to fetch data for export
        return Paymentgetways::query();
    }

    public function create()
    {       
        $this->reset('name','selectpaymentcountry','photo','status','pgwId');
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
    
        try {
        $this->validate([
            'name' => 'required',
            'selectpaymentcountry' => 'required',
            'photo' => 'required',
            'status' => 'required',
        ]);


        $photoPath = $this->photo->store('photo','public');
        Paymentgetways::create([
            'name' => $this->name,
            'selectpaymentcountry' => $this->selectpaymentcountry,
            'photo' => $photoPath,
            'status' => $this->status,
        ]);
 

        $this->dispatch('toastSuccess',$this->heading.' create successfully .');
        $this->closeModal();
        $this->reset('name','selectpaymentcountry','photo','status');
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
   

    public function edit($id)
        {
            $ptc = Paymentgetways::findOrFail($id);
            $this->pgwId = $id;
            $this->name = $ptc->name;
            $this->selectpaymentcountry = $ptc->selectpaymentcountry;
            $this->photo = $ptc->photo;
            $this->status = $ptc->status;

            $this->openModal();
        } 

        public function update()
        {
            $this->validate([
                'name' => 'required',
                'selectpaymentcountry' => 'required',
                'photo' => 'required',
                'status' => 'required',
            ]);
        
            if ($this->pgwId) {
                $post = Paymentgetways::findOrFail($this->pgwId);

                if ($this->photo) {
                    $photoPath = $this->photo->store('photo','public');
                    $post->photo = $photoPath;
                }
                $post->update([
                    'name' => $this->name,
                    'selectpaymentcountry' => $this->selectpaymentcountry,
                    'photo' => $photoPath,
                    'status' => $this->status,
                ]);
        
                $this->dispatch('toastSuccess', $this->heading . ' updated successfully.');
                $this->closeModal();
                $this->reset('name', 'selectpaymentcountry','photo','status','pgwId');
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

    $paymentgetway = Paymentgetways::all();
 
    $query = Paymentgetways::orderBy($this->orderColumn, $this->sortOrder)
        ->select('id', 'name', 'status', 'photo');
    if (!empty($this->searchTerm)) {
        $query->where('name', 'like', '%' . $this->searchTerm . '%');
        $query->orWhere('status', 'like', '%' . $this->searchTerm . '%');
    }
    if (!empty($this->selectedtitle)) {
        $query->where('name', $this->selectedtitle);
    }
    if (!empty($this->status)) {
        $query->where('status', $this->status);
    }
    $paymentgateways = $query->paginate(10);

    return view('livewire.admin.paymentgetway.payment-get-way', compact(['paymentgateways','paymentgetway']));
}



    public function delete($pgwId)
    {
        $ptc = Paymentgetways::findOrFail($pgwId);
        $ptc->delete();
    
        $this->dispatch('toastSuccess', $this->heading . ' successfully deleted.');
    }

    public function status_update($id)
    {
        $course = Paymentgetways::find($id);
    
        if ($course->status == 0) {
            $course->status = 1;
            $course->save();
            $this->dispatch('toastSuccess','status successfully deleted.');
        } else {
            $course->status = 0;
            $course->save();
            session()->flash('success', 'status deactivated successfully.');
        }
    
        return redirect()->route('admin.paymentgetways');
    }

    
}
