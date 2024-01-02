<?php

namespace App\Http\Livewire\Front;

use App\Models\{InputMeta,Payment,Paymentsetting,PaymentMeta,PaymentMetaMultiple};
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class PaymentPreview extends Component
{
    public $payment_id,$payments,$input_data,$paymentsetting,$multiplevalue,$formdata,$amount,$geolocation,$paymethod;
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
        $this->paymethod = 'paytm';
    }
    
    public function update()
    {

        $formdatas = $this->formdata;
        $this->payments->update(['amount'=> $this->amount]);
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

            $this->dispatch('toastSuccess','Form Successfully Updated.');

            $this->showEditModal = false;
        }
    }

    public function render()
    {
        return view('\livewire.front.payment-preview');
    }
    public function edit()
    {
        $this->showEditModal = true;
    }
    public function close()
    {
        $this->showEditModal = false;
    }
    public function paynow()
    {
        return $this->redirect(route('payment.paycheck-out',base64_encode($this->payment_id)), navigate: true);
    }
}
