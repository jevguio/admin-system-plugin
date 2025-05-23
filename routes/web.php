<?php
use plugins\adminsystem\controllers\TuitionPaymentController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\File;
Route::middleware(['web', 'auth'])->group(function () {
    
    Route::get('/tuition-payments', [TuitionPaymentController::class, 'index'])->name('admin.plugin');
    Route::post('/tuition-payments', [TuitionPaymentController::class, 'store']);

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