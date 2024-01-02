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
