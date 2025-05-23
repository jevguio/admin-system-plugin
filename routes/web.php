<?php
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/tuition-payments', [\App\Plugins\TuitionPayment\Controllers\TuitionPaymentController::class, 'index'])->name('admin.plugin');
    Route::post('/tuition-payments', [\App\Plugins\TuitionPayment\Controllers\TuitionPaymentController::class, 'store']);

});

$pluginMigrationPath = __DIR__ . '/migrations';

if (File::exists($pluginMigrationPath)) {
    $migrator = app('migrator');
    $migrator->path($pluginMigrationPath);
    
    $migrationFiles = $migrator->getMigrationFiles($pluginMigrationPath);
    $ranMigrations = $migrator->getRepository()->getRan();

    foreach ($migrationFiles as $migration => $path) {
        if (!in_array($migration, $ranMigrations)) {
            include_once $path;
            (new (require $path))->up(); // manually call up()
            $migrator->getRepository()->log($migration, 1);
        }
    }
}