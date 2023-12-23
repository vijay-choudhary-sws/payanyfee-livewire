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
use App\Http\Livewire\Admin\Course\{CourseList,CourseCreate,CourseEdit,CourseView};
use App\Http\Livewire\Admin\PaymentGetWay\{PaymentGetWay};
use App\Http\Livewire\Admin\Paymentsetting\{PaymentsettingList,PaymentsettingCreate,PaymentsettingEdit,PaymentsettingView};

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

    //Paymentypecourse Routes
    Route::group(['prefix' => 'payment-type-courses'], function () {
        Route::get('/', PaymentTypeCourse::class)->name('payment-type-courses');

    });
    //selectpaymentcourse Routes
    Route::group(['prefix' => 'select-payment-course'], function () {
        Route::get('/', SelectPaymentCourse::class)->name('select-payment-course');

    });
    //school Routes
    Route::group(['prefix' => 'schools'], function () {
        Route::get('/', School::class)->name('schools');

    });
    
     //school Routes
     Route::group(['prefix' => 'school-programs'], function () {
        Route::get('/', SchoolProgram::class)->name('school-programs');

    });

   //school-program-type Routes
   Route::group(['prefix' => 'school-program-type'], function () {
    Route::get('/', SchoolProgramType::class)->name('school-program-type');

    });

    //studentregistration Routes
   Route::group(['prefix' => 'student-registrations'], function () {
    Route::get('/', StudentRegistration::class)->name('student-registrations');

    });

     //paymenttypeconfrences Routes
   Route::group(['prefix' => 'payment-type-confrence'], function () {
    Route::get('/', PaymentTypeConfrence::class)->name('payment-type-confrence');

    });

       //SelectData Routes
   Route::group(['prefix' => 'select-datas'], function () {
    Route::get('/', SelectData::class)->name('select-datas');

    });
    
     //SelectData Routes
   Route::group(['prefix' => 'gsts'], function () {
    Route::get('/', Gst::class)->name('gsts');

    });


         //paymentgetway Routes
   Route::group(['prefix' => 'paymentgetways'], function () {
    Route::get('/', PaymentGetWay::class)->name('paymentgetways');

    });

    Route::group(['prefix' => 'paymentsettings'], function () {
        Route::get('/', PaymentsettingList::class)->name('paymentsettings');
        Route::get('/paymentsettingcreate',  PaymentsettingCreate::class)->name('paymentsettings.paymentsettingcreate');
        Route::get('/{paymentsettings}/paymentsettingedit',  PaymentsettingEdit::class)->name('paymentsettings.paymentsettingedit');
        Route::get('/{id}/paymentsettingview',  PaymentsettingView::class)->name('paymentsettings.paymentsettingview');
        // Route::get('/model-form', PaymentsettingModelView::class)->name('paymentsettings.addfield');
      });



});
