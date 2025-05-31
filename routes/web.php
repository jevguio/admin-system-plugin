<?php
use plugins\adminsystem\controllers\TuitionPaymentController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\File;
Route::middleware(['web', 'auth'])->group(function () {
    
    Route::get('/tuition-payments', [TuitionPaymentController::class, 'index'])->name('admin.plugin');
    Route::post('/tuition-payments', [TuitionPaymentController::class, 'store']);

});
