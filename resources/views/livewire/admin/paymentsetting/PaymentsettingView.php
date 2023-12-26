<?php 

namespace App\Http\Livewire\Admin\Paymentsetting;

use Livewire\Component;
use App\Models\Paymentsetting;

class PaymentsettingView extends Component
{
    public $Paymentsetting;

    public function mount($id)
    {
        $this->Paymentsetting = Paymentsetting::find($id);
    }

    public function render()
    {
       $paymentsettings= $this->Paymentsetting;
        return view('livewire.admin.paymentsetting.paymentsettingview',compact('paymentsettings'));
    }
}
