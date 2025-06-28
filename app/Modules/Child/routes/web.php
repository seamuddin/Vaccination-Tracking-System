<?php

use App\Modules\Child\Http\Controllers\ChildControllers;
use Illuminate\Support\Facades\Route;

Route::group(['Module' => 'Child', 'middleware' => ['auth']], function () {
    Route::prefix('child')->group(function () {
        Route::match(['get', 'post'], '/', [ChildControllers::class, 'list'])->name('child.list');
        Route::get('create', [ChildControllers::class, 'create'])->name('child.create');
        Route::post('store', [ChildControllers::class, 'store'])->name('child.store');
        Route::get('edit/{id}', [ChildControllers::class, 'edit'])->name('child.edit');
        Route::match(['get', 'post'], 'records/{id}', [ChildControllers::class, 'records'])->name('child.records');
    });
});
