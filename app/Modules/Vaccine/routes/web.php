<?php

use App\Modules\Vaccine\Http\Controllers\VaccineController;

Route::group(['Module' => 'Vaccine', 'middleware' => ['auth']], function () {
    Route::prefix('vaccine')->group(function () {
        Route::match(['get', 'post'], '/', [VaccineController::class, 'list'])->name('vaccine.list');
        Route::get('create', [VaccineController::class, 'create'])->name('vaccine.create');
        Route::post('store', [VaccineController::class, 'store'])->name('vaccine.store');
        Route::get('edit/{id}', [VaccineController::class, 'edit'])->name('vaccine.edit');
    });
});
