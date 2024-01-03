<?php

namespace App\Http\Livewire\Front;

use Livewire\Attributes\Layout;
use App\Models\{InputMeta, Payment, Paymentsetting, PaymentsettingMeta, Paymentgetways, PaymentMeta, PaymentMetaMultiple};
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

#[Layout('livewire.admin.layouts.applogin')]
class PaymentType extends Component
{

    public $payment_id, $payments, $geolocation, $formdata, $amount, $multiplevalue, $input_data, $paymentsetting;
    public $showEditModal = false;


    public function mount($payment_id)
    {

        $this->payment_id = base64_decode($payment_id);
        $this->payments = Payment::with('paymentMeta.paymentMetaMultiple')->find($this->payment_id);
        $this->input_data = InputMeta::where('paymentsetting_id', $this->payments->paymentsetting_id)->orderBy('order_by')->get();
        $this->paymentsetting = Paymentsetting::find($this->payments->paymentsetting_id);

        foreach ($this->payments->paymentMeta  as $input) {

            if (count($input->paymentMetaMultiple) > 0) {
                foreach ($input->paymentMetaMultiple as $val) {
                    $this->multiplevalue[] = $val->meta_value;
                }
                $this->formdata[$input->id] = $this->multiplevalue;
            } else {
                $this->formdata[$input->id] = $input->meta_value;
            }
        }

        $this->amount = $this->payments->amount;
        $this->geolocation = 'IN';
    }

    public function render()
    {
        $payments = Paymentsetting::where('status', 1)->get();

        return view('livewire.front.payment-type', ['payments' => $payments]);
    }


    public function update()
    {

        $formdatas = $this->formdata;

        foreach ($formdatas as $key => $formdata) {
            $payment = PaymentMeta::find($key);
            if (is_array($formdata)) {


                $meta_multiple = PaymentMetaMultiple::where('payment_meta_id', $payment->id)->get();
                foreach ($meta_multiple as $val) {
                    PaymentMetaMultiple::destroy($val->id);
                }
                foreach ($formdata as $value) {
                    PaymentMetaMultiple::create([
                        'meta_name' => $key,
                        'meta_value' => $value,
                        'payment_meta_id' => $key,
                    ]);
                }
            } else {
                $payment->update(['meta_value' => $formdata]);
            }
        }
    }

    public function edit(){
        $this->showEditModal = true;
    }
}
