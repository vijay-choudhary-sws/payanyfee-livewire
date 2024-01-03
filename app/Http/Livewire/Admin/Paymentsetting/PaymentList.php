<?php

namespace App\http\Livewire\Admin\Paymentsetting;

use App\Models\Payment;
use App\Models\Paymentsetting;
use Livewire\Component;

class PaymentList extends Component
{
    public $heading = 'Payment List';
    public $searchTerm, $PaymentsettingAll, $status;
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortLink = '<i class="sorticon bx bx-caret-up"></i>';
    public $search, $selectedtitle;
    public $filterApplied = false;

    public function mount($paymentsetting)
    {
        if($paymentsetting != 0){
            $this->selectedtitle = $paymentsetting;
        }
        $this->PaymentsettingAll = Paymentsetting::all();
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

    public function columnSortOrder($columnName = "")
    {
        $caretOrder = "up";
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = "down";
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = "up";
        }
        $this->sortLink = '<i class="sorticon bx bx-caret-' . $caretOrder . '"></i>';
        $this->orderColumn = $columnName;
    }

    public function render()
    {
        $payments = Payment::with('paymentsetting')->orderby($this->orderColumn, $this->sortOrder)
            ->select('*');

        $search = '%' . $this->search . '%';
        $status = '%' . $this->status . '%';

        if (!empty($this->search)) {
            // $payments->orWhere('title','like',$search);
            $payments->orWhere('name', 'like', $search);
            $payments->orWhere('email', 'like', $search);
            $payments->orWhere('phone', 'like', $search);
            $payments->orWhere('amount', 'like', $search);
        }

        if (!empty($this->selectedtitle)) {
            $payments->where('paymentsetting_id', $this->selectedtitle);
        }

        if (!empty($this->status)) {
            $payments->Where('status', 'like', $status);
        }


        $payments =  $payments->paginate(10);

        // echo "<pre>";print_r($payments);die;
        return view('livewire.admin.paymentsetting.payment-list', compact('payments'));
    }
}
