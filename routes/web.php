<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Front\FrontWelcome;


Auth::routes();

Route::get('/', FrontWelcome::class);
