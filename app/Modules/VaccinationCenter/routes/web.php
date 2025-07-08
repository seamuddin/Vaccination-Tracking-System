<?php

use App\Modules\VaccinationCenter\Http\Controllers\VaccinationCenterController;
use Illuminate\Support\Facades\Route;

Route::group(['Module' => 'VaccinationCenter', 'middleware' => ['auth']], function () {
    Route::prefix('vaccination-center')->group(function () {
        Route::match(['get', 'post'], '/', [VaccinationCenterController::class, 'list'])->name('vaccinationcenter.list');
        Route::get('create', [VaccinationCenterController::class, 'create'])->name('vaccinationcenter.create');
        Route::post('store', [VaccinationCenterController::class, 'store'])->name('vaccinationcenter.store');
        Route::get('edit/{id}', [VaccinationCenterController::class, 'edit'])->name('vaccinationcenter.edit');
        Route::match(['get', 'post'], 'records/{id}', [VaccinationCenterController::class, 'records'])->name('vaccinationcenter.records');
    });
});
