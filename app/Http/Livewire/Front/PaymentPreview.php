<?php

namespace App\Http\Livewire\Front;

use App\Models\{InputMeta, Payment, Paymentgetways, Paymentsetting, PaymentMeta, PaymentMetaMultiple, SettingWithGetways, Posts, Multioption};
use Livewire\Attributes\{Layout, Validate};
// use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class PaymentPreview extends Component
{
    public $payment_id, $payments, $input_data, $paymentsetting, $multiplevalue, $formdata, $amount, $geolocation, $paymentGateways, $paygetway, $muloptionss = [], $dpci = [], $mulopti = [];
    public $showEditModal = false;
    public $name, $email, $phone;
    public $mutiioption, $muloptions = [],$the;
    #[Validate('required', message: 'Please select any gateway.')]
    public $paymethod;

    protected $listeners = ['store', 'amountchangefront', 'updatedSelectdata'];
    public function mount($payment_id)
    {
       
        $this->payment_id = base64_decode($payment_id);
        // $this->payments = Payment::with('paymentMeta.paymentMetaMultiple.post')->find($this->payment_id);
        $this->payments = Payment::with('paymentMeta.freeho')->find($this->payment_id);

        // echo "<pre>";print_r($this->payments->toArray());die;
        $this->input_data = InputMeta::with('multioption', 'paymentMeta')->where('paymentsetting_id', $this->payments->paymentsetting_id)->orderBy('order_by')->get();

        // echo "<pre>";print_r($this->input_data->toArray());die;
        $this->paymentGateways = Paymentgetways::whereStatus(1)->get();
        $this->paygetway = SettingWithGetways::with('getway')->where('paymentsetting_id', $this->payments->paymentsetting_id)->get();

        // echo "<pre>";print_r($this->paygetway->toArray());die;

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


        // echo "<pre>";
        // print_r($this->formdata);
        // die;

        $this->name = $this->payments->name;
        $this->email = $this->payments->email;
        $this->phone = $this->payments->phone;
        $this->amount = $this->payments->amount;
        $this->geolocation = 'IN';

        // $this->mulopti[$key] = [$val];
        // $this->mulopti[$kee] = [2,2,2];

        $this->mutiioption = InputMeta::with('multioption')->where('is_multiple_required', 1)->get();


        foreach ($this->mutiioption as $item) {

            foreach ($item->multioption as $key => $option) {

                $this->muloptions[$item->id][$key] = '';
            }
        }


        foreach($this->payments->paymentMeta as $key => $value){

            foreach($value->paymentMetaMultiple as $keys => $thd){
                if($keys == 0){
                $post = Posts::find($value->meta_value);
                $this->muloptionss[$keys] = Posts::where('category_id', @$post->dependency_category_id)->get();
                // echo"<pre>";print_r($this->muloptionss);die;
            }else{
                $post = Posts::find($thd->meta_value);
                $this->muloptionss[$keys] = Posts::where('category_id', @$post->dependency_category_id)->get();
            }
               
                // echo"<pre>";print_r($value->toArray());die;
            }
         

        }

        $this->mutiioption = InputMeta::with('multioption')->where('is_multiple_required', 1)->get();
      



        foreach ($this->payments->paymentMeta as $item){
            foreach($item->paymentMetaMultiple as $key=>$val){

                $this->muloptions[$item->meta_name][$key] = $val->meta_value ?? '';
            
            }
          

        }
        
    }

    public function updatedSelectdata($id)
    {
        $post = Posts::find($id);
        $this->muloptionss[0] = Posts::where('category_id', $post->dependency_category_id)->get();
    }

    public function mi($itemId, $key)
    {
        // echo $itemId;die;

        $post = Posts::find($this->muloptions[$itemId][$key]);
        $this->muloptionss[$key + 1] = Posts::where('category_id', $post->dependency_category_id)->get();
        // echo"<pre>";print_r($this->muloptionss[$key + 1]);die;

    }



    public function update()
    {

        $formdatas = $this->formdata;
        $this->payments->update([
            'amount' => $this->amount,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
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

     
        $meta_multiple = PaymentMetaMultiple::get();
        // echo"<pre>";print_r($meta_multiple->toArray());die;
        
                foreach ($meta_multiple as $val) {
                    PaymentMetaMultiple::destroy($val->id);

             
                }

      
        foreach($this->muloptions as $value){
          
            foreach ($value as $key => $values) {
              
                PaymentMetaMultiple::create([
                    'payment_meta_id' => $payment->id,
                    'meta_value' => $values, 
                ]);
           
        }

        
      
    }

    

            $this->dispatch('toastSuccess', 'Form Successfully Updated.');

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
        $this->validate();

        Payment::whereId($this->payment_id)
            ->update(['paymentgetway_id' => $this->paymethod]);

        return $this->redirect(route('payment.paycheck-out', [base64_encode($this->payment_id), base64_encode($this->paymethod)]), navigate: true);
    }
}
