<?php


namespace App\Http\Livewire\Front;

use App\Models\GatewayMeta;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use App\Models\Paymentsetting;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class PaycheckOut extends Component
{
    public $paymentId, $gatewayId, $payment, $amount, $paymentMode, $charges = [], $totalamount = [];

    #[Validate('required', message: 'Please Select Payment Mode.')]
    public $paymode;

    public function mount($payment_id, $gateway_id)
    {
        $this->paymentId = base64_decode($payment_id);
        $this->gatewayId = base64_decode($gateway_id);

        $this->payment = Payment::find($this->paymentId);
        $this->amount = $this->payment->amount;

        $this->paymentMode = GatewayMeta::with('paymentMode')->where('getway_id', $this->gatewayId)->where('status', 1)->get();

        foreach ($this->paymentMode as $mode) {
            $this->charges[$mode->id] = $mode->amount;
            if ($mode->is_percent) {
                $totalamount = $this->payment->amount + ($this->payment->amount * $mode->amount) / 100;
            } else {
                $totalamount = $this->payment->amount + $mode->amount;
            }
            $this->totalamount[$mode->id] = $totalamount;
        }
   
    }

    public function render()
    {
        return view('livewire.front.paycheck-out');
    }

    public function cancle()
    {
        return $this->redirect(route('payment.preview', base64_encode($this->paymentId)), navigate: true);
    }

    public function paynow()
    {
        $this->validate();

        Payment::whereId($this->paymentId)->update([
            'paymentmode_id' => $this->paymode,
            'charges'=> $this->charges[$this->paymode],
            'total_amount'=>$this->totalamount[$this->paymode],
        ]);
        
        return $this->redirect(route('payment.preview', base64_encode($this->paymentId)), navigate: true);
    }
}
