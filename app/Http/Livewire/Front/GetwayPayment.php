<?php

namespace App\http\Livewire\Front;

use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class GetwayPayment extends Component
{
    public $paymentId,$payment;
    public $pay = false;


    public function mount($payment_id){
        $this->paymentId = base64_decode($payment_id);
        $this->payment = Payment::find($this->paymentId);

        if($this->payment->transaction_status){
            $this->pay = true;    
        }

    }

    public function payamount(){
        
        Payment::whereId($this->paymentId)->update([
            'transaction_date' => Carbon::now()->toDateTimeString(),
            'tid' => rand(),
            'order_id' => rand(),
            'currency' => 'INR',
            'transaction_status' => 1,
        ]);

        $this->pay = true;
    }

    public function render()
    {
        return view('livewire.front.getway-payment');
    }
}
