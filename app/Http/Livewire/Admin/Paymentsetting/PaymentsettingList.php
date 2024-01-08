<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Paymentsetting;
use Livewire\WithPagination;

class PaymentsettingList extends Component
{
    use WithPagination;

    public $heading = 'Payment Setting';
    public $searchTerm;
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';
    public $Payments;
    public $search;
    public $selectedtitle;
    public $status;
    public $filterApplied = false;
    public $clearfilter = "";
    public $isOpen;
    public function mount()
    {
        $this->Payments= Paymentsetting::all();
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
        // Reset other filter properties if needed...
    }


    public function updated(){
         $this->resetPage();
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
        $PaymentsettingAll = Paymentsetting::all();
        $Paymentsetting = Paymentsetting::orderby($this->orderColumn,$this->sortOrder)
        ->select('id','title','slug','cc_email','bcc_email','status');
        // $searchQuery = '%'.$this->searchTerm.'%';
        $search = '%'.$this->search.'%';
        $status = '%'.$this->status.'%';
        if(!empty($this->search)){
            $Paymentsetting->orWhere('title','like',$search);
            $Paymentsetting->orWhere('slug','like',$search);
            $Paymentsetting->orWhere('cc_email','like',$search);
            $Paymentsetting->orWhere('bcc_email','like',$search);
            // $Paymentsetting->orWhere('status','like',$search);
       }
          if (!empty($this->selectedtitle)) {
            $Paymentsetting->where('title', $this->selectedtitle);
        }
         if(!empty($this->status)){
            $Paymentsetting->orWhere('status','like',$status);
          }
          $Paymentsettings = $Paymentsetting->paginate(10);
        
        return view('livewire.admin.paymentsetting.paymentsettinglist',compact(['Paymentsettings','PaymentsettingAll']));
    }

    public function delete(Paymentsetting $Paymentsetting)
    {
        $Paymentsetting->delete();
        $this->dispatch('toastSuccess',$this->heading.' successfully deleted.');

    }
    
    public function status_update($paymentSettingId)
    {
        $Payments = Paymentsetting::find($paymentSettingId);
  
        if ($Payments->status == 0) {
            $Payments->status = 1;
            $Payments->save();
            $this->dispatch('toastSuccess','status successfully changed.');
        } else {
            $Payments->status = 0;
            $Payments->save();
            $this->dispatch('toastSuccess','status successfully changed.');

        }
    
    }

    public function view($id)
        {
            $Paymentsetting = Paymentsetting::find($id);

            return view('livewire.admin.paymentsetting.paymentsettingview',compact('Paymentsetting'));
        }



}

