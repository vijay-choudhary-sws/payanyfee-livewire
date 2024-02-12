<?php

namespace App\Http\Livewire\Front;


use App\Models\{PaymentsettingMeta, Payment, Paymentsetting, Categories, InputMeta, PaymentMeta, PaymentMetaMultiple, posts, Multioption, Dependencymeta};
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Livewire;

#[Layout('livewire.admin.layouts.applogin')]
class PaymentDetail extends Component
{
    public $paymentMetas, $paymentsetting, $geolocation, $Categories, $paymentType, $input_data, $FormInput, $front = true, $formdata, $amount, $name, $email, $phone, $amountType, $typeselect, $muloptionss = [], $categoryid = [], $mutiioption, $muloptions = [];

    protected $listeners = ['store', 'amountchangefront', 'updatedSelectdata'];


    public function amountchangefront($id)
    {
        $post = Posts::find($id);

        $this->amount = $post ? $post->amount : '';
    }

    public function updatedSelectdata($id)
    {
        $post = Posts::find($id);
        $this->muloptionss[0] = Posts::where('category_id', $post->dependency_category_id)->get();
       
        
    }

    public function mi($itemId,$key)
    {
        // echo $itemId;die;
       
        $post = Posts::find($this->muloptions[$itemId][$key]);
        $this->muloptionss[$key + 1] = Posts::where('category_id', $post->dependency_category_id)->get();
        // echo"<pre>";print_r($this->muloptionss[$key + 1]);die;

    }


    public function mount($slug)
    {
        $this->amount = 0;
        $this->typeselect = 0;
        $this->paymentsetting = Paymentsetting::whereSlug($slug)->first();
        $this->amountType = $this->paymentsetting->amount_type;
        if ($this->amountType == 1) {
            $this->amount = $this->paymentsetting->fixed_amount;
        }
        $this->input_data = InputMeta::where('paymentsetting_id', $this->paymentsetting->id)->orderBy('order_by')->get();

        $this->formdata = [];



        foreach ($this->input_data as $input) {

            if ($input->inputType->type == 'radio' || $input->inputType->type == 'checkbox' || ($input->inputType->type == 'select' && $input->input_select_data == null) || ($input->inputType->type == 'select_amount' && $input->input_select_data == null)) {

                if ($input->inputType->type == 'checkbox') {
                    $this->formdata[$input->id] = [$input->metaOption->firstWhere('is_default', '1')?->option_value];
                } else {
                    $this->formdata[$input->id] = $input->metaOption->firstWhere('is_default', '1')?->option_value;
                    if ($input->inputType->type == 'select_amount') {
                        $this->amount = $input->metaOption->firstWhere('is_default', '1')?->option_value;
                    }
                }
            }
        }

        $category = Categories::get();
        $categoryid = [];
        foreach ($category as $value) {
            $this->categoryid[] = $value->id;
        }

        $this->mutiioption = InputMeta::with('multioption')->where('is_multiple_required', 1)->get();
      

        foreach ($this->mutiioption as $item) {
            foreach ($item->multioption as $key => $option) {
               
                $this->muloptions[$item->id][$key] = '';
              
            }
        }
    }

    public function render()
    {
        $in_data = InputMeta::get();
        $multi = Multioption::get();

        return view('livewire.front.payment-detail', compact('in_data', 'multi'));
    }


    public function submitForm()
    {

        return Redirect::route('payment.select-payment-type', ['id' => 1])->with(['navigate' => true]);
    }

    public function store()
    {
        // try {
        $formdatas = $this->formdata;
        $payment_meta_id = null; 
      
        $this->validate([
            // 'name' => 'required',
            // 'email' => 'required|email',
            // 'phone' => 'required|numeric',
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
                $payment_meta = PaymentMeta::create([
                    'paymentsetting_id' => $this->paymentsetting->id,
                    'meta_name' => $key,
                    'meta_value' => '',
                    'payment_id' => $payment_id,
                ]);
                $payment_meta_id = $payment_meta->id;
            } else {
              $payment_meta =  PaymentMeta::create([
                    'paymentsetting_id' => $this->paymentsetting->id,
                    'meta_name' => $key,
                    'meta_value' => $formdata,
                    'payment_id' => $payment_id,
                ]);
                $payment_meta_id = $payment_meta->id;
            }
        }
        $muloptionsvalue = $this->muloptions;
        // echo "<pre>";print_r($muloptionsvalue);die;
        foreach($this->muloptions as $value){
        foreach ($value as $key => $values) {

            PaymentMetaMultiple::create([
                'payment_meta_id' => $payment_meta_id,
                'meta_value' => $values, 
            ]);
        }
    }
        


        return $this->redirect(route('payment.preview', base64_encode($payment_id)), navigate: true);
    //     } catch (ValidationException $e) {
    //         $errors = $e->errors();
    //         $errorMessages = [];

    //         foreach ($errors as $field => $messages) {
    //             $errorMessages[] = $field . ': ' . implode(', ', $messages);
    //         }

    //         $errorMessage = implode('<br>', $errorMessages);

    //         $this->dispatch('toastError', $errorMessage);
    //     } catch (\Exception $e) {
    //         $this->dispatch('toastError', 'An error occurred while processing your request.');
    //     }
    // }
    }
}
