<?php

namespace App\Http\Livewire\Admin\Paymentsetting;

use App\Models\{Payment,InputMeta};
use Livewire\Component;

class PaymentPreview extends Component
{
    public $payment_id,$payments,$input_data,$heading = 'Payment Preview';

    public function mount($payment_id)
    {
        $this->payment_id = $payment_id;
        $this->payments = Payment::with('paymentMeta.paymentMetaMultiple')->find($this->payment_id);
        $this->input_data = InputMeta::where('paymentsetting_id', $this->payments->paymentsetting_id)->orderBy('order_by')->get();
    }
    
    public function render()
    {
        return view('\livewire.admin.paymentsetting.payment-preview');
    }
}
