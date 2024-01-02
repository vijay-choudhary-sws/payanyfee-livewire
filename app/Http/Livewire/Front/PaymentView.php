<?php

namespace App\Http\Livewire\Front;

use Livewire\Attributes\Layout;
use App\Models\Paymentsetting;
use Livewire\Component;

#[Layout('livewire.admin.layouts.applogin')]
class PaymentView extends Component
{

    public function render()
    {
        $payments = Paymentsetting::where('status', 1)->get();
      
        return view('livewire.front.payment-view', compact('payments'));
    }
}
