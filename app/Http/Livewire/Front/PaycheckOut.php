<?php


namespace App\Http\Livewire\Front;

use Livewire\Attributes\Layout;
use App\Models\Paymentsetting;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class PaycheckOut extends Component
{
    public $paymentId;

    public function mount($payment_id)
    {
        $this->paymentId = base64_decode($payment_id);
    }
    public function render()
    {
       return view('livewire.front.paycheck-out');
    }
    public function cancle()
    {
        return $this->redirect(route('payment.preview',base64_encode($this->paymentId)), navigate: true);
    }

}



