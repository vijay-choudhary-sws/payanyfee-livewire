<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\{AdminController, AdminLoginController};
use App\Http\Livewire\Admin\PaymentTypeCourse\{PaymentTypeCourse};
use App\Http\Livewire\Admin\SelectPaymentCourse\{SelectPaymentCourse};
use App\Http\Livewire\Admin\School\{School};
use App\Http\Livewire\Admin\SchoolProgram\{SchoolProgram};
use App\Http\Livewire\Admin\SchoolProgramType\{SchoolProgramType};
use App\Http\Livewire\Admin\StudentRegistration\{StudentRegistration};
use App\Http\Livewire\Admin\PaymentTypeConfrence\{PaymentTypeConfrence};
use App\Http\Livewire\Admin\SelectData\{SelectData};
use App\Http\Livewire\Admin\Gst\{Gst};
use App\Http\Livewire\Admin\Course\{CourseList, CourseCreate, CourseEdit, CourseView};
use App\Http\Livewire\Admin\PaymentGetWay\{PaymentGetWay};
use App\Http\Livewire\Admin\Paymentsetting\{PaymentList, PaymentPreview, PaymentsettingList, PaymentsettingCreate, PaymentsettingEdit, PaymentsettingView};
use App\Http\Livewire\Admin\Post\{post};
use App\Http\Livewire\Admin\Category\{Category};

use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'guest:admin'], function () {
    // Admin login routes
    Route::get('login', AdminLoginController::class)->name('login');
    Route::post('login', AdminLoginController::class)->name('login.submit');
});


// Protected admin routes (requires authentication)
Route::group([
    'middleware' => 'auth:admin',
], function () {
    // Logout route
    Route::post('logout', function () {
        Auth::guard('admin')->logout();
        return to_route('admin.login');
    })->name('logout');

    // Dashboard route
    Route::get('dashboard', AdminController::class)->name('dashboard');
    Route::get('/', AdminController::class);


    //SelectData Routes
    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', CourseList::class)->name('courses');
        Route::get('/coursecreate', CourseCreate::class)->name('courses.coursecreate');
        Route::get('/{course}/courseedit', CourseEdit::class)->name('courses.courseedit');
        Route::get('/{id}/view', CourseView::class)->name('courses.view');
    });

    Route::get('payment-type-courses', PaymentTypeCourse::class)->name('payment-type-courses');
    Route::get('select-payment-course', SelectPaymentCourse::class)->name('select-payment-course');
    Route::get('schools', School::class)->name('schools');
    Route::get('school-programs', SchoolProgram::class)->name('school-programs');
    Route::get('school-program-type', SchoolProgramType::class)->name('school-program-type');
    Route::get('student-registrations', StudentRegistration::class)->name('student-registrations');
    Route::get('payment-type-confrence', PaymentTypeConfrence::class)->name('payment-type-confrence');
    Route::get('select-datas', SelectData::class)->name('select-datas');
    Route::get('gsts', Gst::class)->name('gsts');
    Route::get('paymentgetways', PaymentGetWay::class)->name('paymentgetways');

    
    Route::get('post', Post::class)->name('posts');
    Route::get('category', Category::class)->name('categorys');

    Route::group(['prefix' => 'paymentsettings'], function () {
        Route::get('/', PaymentsettingList::class)->name('paymentsettings');
        Route::get('/paymentsettingcreate',  PaymentsettingCreate::class)->name('paymentsettings.paymentsettingcreate');
        Route::get('/{paymentsettings}/paymentsettingedit',  PaymentsettingEdit::class)->name('paymentsettings.paymentsettingedit');
        Route::get('/{id}/paymentsettingview',  PaymentsettingView::class)->name('paymentsettings.paymentsettingview');
        Route::get('/payment-preview/{payment_id}',  PaymentPreview::class)->name('paymentsettings.paymentpreview');
        Route::get('/payment-list/{paymentsetting}',  PaymentList::class)->name('paymentsettings.paymentList');
        // Route::get('/model-form', PaymentsettingModelView::class)->name('paymentsettings.addfield');
    });
});
