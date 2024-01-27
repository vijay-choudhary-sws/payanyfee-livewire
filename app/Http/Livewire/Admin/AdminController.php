<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\{Paymentsetting, Payment, Paymentgetways};
use Carbon\Carbon;
use Illuminate\Support\Number;

class AdminController extends Component
{
    public $paymentsetting, $payment, $todaysAmount, $paymentgetway, $groupbyamount, $datetime, $chartData, $gaywaychartData, $paymentsettingcg, $getwaytodaysAmount,$amountsum=[],$paymentgetways,$amountgetsum=[];

    public function mount()
    {
       
        $paymentsetting = Paymentsetting::count();
        $this->paymentsetting = Number::forHumans($paymentsetting);

        $payment = Payment::sum('total_amount');
        $this->payment = Number::forHumans($payment);

        $todaysAmount = Payment::whereDate('created_at', Carbon::today())->sum('amount');
        $this->todaysAmount = Number::forHumans($todaysAmount);

        $paymentgetway = Paymentgetways::count();
        $this->paymentgetway = Number::forHumans($paymentgetway);

        $this->groupbyamount = Payment::with('paymentsetting')->groupBy('paymentsetting_id')->selectRaw('paymentsetting_id, sum(total_amount) as total_amount')->get();


        $this->paymentsettingcg = Paymentsetting::get();
        foreach ($this->paymentsettingcg as $value) {
            $this->amountsum[$value->id] = Payment::where('paymentsetting_id', $value->id)
                ->whereDate('created_at', Carbon::today())
                ->sum('amount');
                
        }
        
        $this->paymentgetways = Paymentgetways::get();
        foreach ($this->paymentgetways as $getvslue) {
            $this->amountgetsum[$getvslue->id] = Payment::where('paymentgetway_id', $getvslue->id)
                ->whereDate('created_at', Carbon::today())
                ->sum('amount');

                
        }
        
       
        $this->chartData = $this->getCollection();
        $this->gaywaychartData  = $this->getwayCollection();
    }


    public function getCollection()
    {
        $data = Payment::with('paymentsetting')
            ->groupBy('paymentsetting_id')
            ->selectRaw('paymentsetting_id, sum(total_amount) as total_amount')
            ->get();
        // echo"<pre>";print_r($data->toArray());die;
        return $data;
    }

    public function getwayCollection()
    {
        $data = Payment::with('paymentGetway')
            ->groupBy('paymentgetway_id')
            ->selectRaw('paymentgetway_id, sum(total_amount) as total_amount')
            ->get();

            // echo"<pre>";print_r($data->toArray());die;
        return $data;
    }


    public function render()
    {




        // $this->todaysAmountPayment = Payment::with('paymentsetting')
        // ->whereDate('created_at', Carbon::today())
        // ->get();


        return view('livewire.admin.dashboard');
    }
}
