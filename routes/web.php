<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Front\{FrontWelcome,PaymentDetail,PaymentView,PaymentType,PaymentPreview};
// use App\Http\Livewire\Front\Common\PaymentPreview;
use App\Http\Livewire\Front\PaycheckOut;
Auth::routes();

Route::get('/', FrontWelcome::class);
Route::group(['prefix' => 'payment'], function () {
    Route::get('/', PaymentView::class)->name('front.payment-view');
    Route::get('/paymentdetail/{slug}', PaymentDetail::class);
    Route::get('select-payment-type/{payment_id}',PaymentType::class)->name('payment.select-payment-type');
    Route::get('/paycheck-out/{payment_id}', PaycheckOut::class)->name('payment.paycheck-out');
    // Route::get('/preview/{payment_id}', PaymentPreview::class)->name('payment.preview');
    Route::get('/preview/{payment_id}', PaymentPreview::class)->name('payment.preview');
});

