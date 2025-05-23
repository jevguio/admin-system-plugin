<?php
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
Route::middleware(['web','auth'])->group(function () {
    Route::get('/admin-plugin', function () {
        if (Auth::check()) {
            $user = Auth::user();
            // Do something with $user if needed
        }

        return view('adminsystem::admin');
    })->name('admin.plugin'); 

});

