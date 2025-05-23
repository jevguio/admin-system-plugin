<?php
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/tuition-payments', [\App\Plugins\TuitionPayment\Controllers\TuitionPaymentController::class, 'index'])->name('admin.plugin');
    Route::post('/tuition-payments', [\App\Plugins\TuitionPayment\Controllers\TuitionPaymentController::class, 'store']);

});

