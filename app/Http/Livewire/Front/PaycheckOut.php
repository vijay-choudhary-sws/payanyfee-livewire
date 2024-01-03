<?php


namespace App\Http\Livewire\Front;

use Livewire\Attributes\Layout;
use App\Models\Paymentsetting;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class PaycheckOut extends Component
{
    public $paymentId,$gatewayId;

    public function mount($payment_id,$gateway_id)
    {
        $this->paymentId = base64_decode($payment_id);
        $this->gatewayId = base64_decode($gateway_id);
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



