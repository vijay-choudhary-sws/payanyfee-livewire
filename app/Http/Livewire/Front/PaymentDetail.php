<?php

namespace App\Http\Livewire\Front;

use App\Models\Category;
use App\Models\Paymentsetting;
use App\Models\PaymentsettingMeta;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class PaymentDetail extends Component
{
    public $paymentMetas;
    public $paymentsetting;
    public $geolocation;
    public $Categories;

    public function selectpayment($request)
	{
        //  echo "<pre>";print_r($request->all());die;
         $data['paymentsetting_meta'] = Paymentsetting_meta::where('paymentsetting_id',$request->paymentType)->get();

         $rules = [];
		$postData =  $request->all();
		$data['geolocation'] = 'IN';
		$data['string'] = json_encode($postData);
        //  echo '<pre>';print_r($data['string']);die;
		$data['title'] = 'Select PaymentSetting';
		$data['paymentTypeid'] = $postData['paymentType'];
		$data['paygetImages'] = Paymentgetway::where('status', 1)->get();
        $tempdata = array(
			'paymentType' => $request->paymentType,
			'formData' =>$data['string'],
		);
		$paymentType= DB::table('payment_temp_datas')->insertGetId($tempdata);
        $encodedId =  base64_encode($paymentType);//mw==
        // echo '<pre>';print_r($paymentType);die;
        return response()->json(['tempurl'=>route('payment_temp_data',['id'=>$encodedId]),'success'=>1]);
	}

    public function mount($slug)
    {
        $this->geolocation = 'IN';
        $this->Categories = Category::all();
        $this->paymentsetting = Paymentsetting::whereSlug($slug)->first();
        $this->paymentMetas = PaymentsettingMeta::wherePaymentsetting_id($this->paymentsetting->id)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.front.payment-detail');
    }
}
