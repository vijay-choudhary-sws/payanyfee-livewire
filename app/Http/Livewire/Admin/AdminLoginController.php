<?php

namespace App\Http\Livewire\Admin;
 

 
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Component
{

    //todo: admin login functionality
    public function mount(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // echo auth('admin')->user()->name;die;

            return to_route('admin.dashboard');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }
    }

    
    //todo: admin login form
    public function render()
    {
        // echo auth('admin')->user()->name;die;

        return view('livewire.admin.login-form')->layout('livewire.admin.layouts.applogin');
    }


}