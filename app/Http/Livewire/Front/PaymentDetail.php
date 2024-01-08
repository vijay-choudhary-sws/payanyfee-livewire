<?php

namespace App\Http\Livewire\Front;


use App\Models\{PaymentsettingMeta, Payment, Paymentsetting, Category, InputMeta, PaymentMeta, PaymentMetaMultiple};
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

#[Layout('livewire.admin.layouts.applogin')]
class PaymentDetail extends Component
{
    public $paymentMetas, $paymentsetting, $geolocation, $Categories, $paymentType, $input_data, $FormInput, $front = true, $formdata, $amount, $name, $email, $phone, $amountType;
    protected $listeners = ['store'];

    public function mount($slug)
    {

        $this->paymentsetting = Paymentsetting::whereSlug($slug)->first();          
        $this->amountType = $this->paymentsetting->amount_type;
        if($this->amountType == 1){
            $this->amount = $this->paymentsetting->fixed_amount; 
        }
        $this->input_data = InputMeta::where('paymentsetting_id', $this->paymentsetting->id)->orderBy('order_by')->get();
        $this->formdata = [];


        foreach ($this->input_data as $input) {
            if ($input->inputType->type == 'radio' || $input->inputType->type == 'checkbox' || ($input->inputType->type == 'select' && $input->input_select_data == null) || ($input->inputType->type == 'select_amount' && $input->input_select_data == null)) {

                if ($input->inputType->type == 'checkbox') {
                    $this->formdata[$input->id] = [$input->metaOption->firstWhere('is_default', '1')->option_value];
                }  elseif ($input->inputType->type == 'select_amount') {
                    $this->formdata[$input->id] = [$input->metaOption->firstWhere('is_default', '1')->option_amount];
                }else {
                    $this->formdata[$input->id] = $input->metaOption->firstWhere('is_default', '1')->option_value;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.front.payment-detail');
    }


    public function submitForm()
    {

        return Redirect::route('payment.select-payment-type', ['id' => 1])->with(['navigate' => true]);
    }

    public function store()
    {
        try {
            $formdatas = $this->formdata;
            $this->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'amount' => 'required',
            ]);

            $payment_id = Payment::create([
                'paymentsetting_id' => $this->paymentsetting->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'amount' => $this->amount,
            ])->id;

            foreach ($formdatas as $key => $formdata) {
                if (is_array($formdata)) {
                    $payment_meta_id = PaymentMeta::create([
                        'paymentsetting_id' => $this->paymentsetting->id,
                        'meta_name' => $key,
                        'meta_value' => '',
                        'payment_id' => $payment_id,
                    ])->id;
                    foreach ($formdata as $value) {
                        PaymentMetaMultiple::create([
                            'meta_name' => $key,
                            'meta_value' => $value,
                            'payment_meta_id' => $payment_meta_id,
                        ]);
                    }
                } else {
                    PaymentMeta::create([
                        'paymentsetting_id' => $this->paymentsetting->id,
                        'meta_name' => $key,
                        'meta_value' => $formdata,
                        'payment_id' => $payment_id,
                    ]);
                }
            }

            return $this->redirect(route('payment.preview', base64_encode($payment_id)), navigate: true);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessages = [];

            foreach ($errors as $field => $messages) {
                $errorMessages[] = $field . ': ' . implode(', ', $messages);
            }

            $errorMessage = implode('<br>', $errorMessages);

            $this->dispatch('toastError', $errorMessage);
        } catch (\Exception $e) {
            $this->dispatch('toastError', 'An error occurred while processing your request.');
        }
    }
}
