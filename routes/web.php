<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Front\FrontWelcome;
use App\Http\Livewire\Front\PaymentDetail;
use App\Http\Livewire\Front\PaymentView;

Auth::routes();

Route::get('/', FrontWelcome::class);
Route::group(['prefix' => 'payment'], function () {
    Route::get('/', PaymentView::class)->name('front.payment-view');
    Route::get('{slug}', PaymentDetail::class);
});
