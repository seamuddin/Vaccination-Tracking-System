<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */


// Route::group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login-check', [LoginController::class, 'loginCheck'])->name('login.check');

    Route::get('register', [LoginController::class, 'register'])->name('register');
    Route::post('register-store', [LoginController::class, 'registerStore'])->name('register.store');

// });

Route::get('/', [FrontendController::class, 'home'])->name('home');

Route::group(array('middleware' => ['web', 'auth']), function () {
    Route::get('/guardian_portfolio', [FrontendController::class, 'guardianPortfolio'])->name('guardianPortfolio');
    Route::get('/child/register', [FrontendController::class, 'childRegisterForm'])->name('child.register.form');
    Route::get('/child/edit/{id}', [FrontendController::class, 'childEdit'])->name('child.edit.form');

    Route::post('/child/register', [FrontendController::class, 'childRegisterStore'])->name('child.register.store');

    Route::get('/child/profile/{id}', [FrontendController::class, 'childProfile'])->name('child.profile');

    Route::match(['get', 'post'], 'child/schedule/{id}', [FrontendController::class, 'records'])->name('child.vaccine.records');
    Route::get('/child/{childId}/vaccination-card/print', [FrontendController::class, 'printVaccinationCard'])->name('child.vaccine.print-card');
    
    Route::get('/child-vaccination-records/{id}', [FrontendController::class, 'childVaccinationRecords'])->name('child.vaccination.records');
    Route::get('/guardian/profile', [FrontendController::class, 'gurdianProfile'])->name('guardian.profile');
    Route::get('/child/list', [FrontendController::class, 'childListDetails'])->name('guardian.child.list');

    Route::get('/gurdian/reset-password', [FrontendController::class, 'gurdian_reset_password'])->name('guardian_reset_password');
    Route::post('/gurdian/reset-password', [FrontendController::class, 'gurdian_reset_password_update'])->name('gurdian_reset_password_update');
});

Route::get( 'logout', array( LoginController::class, 'logout' ) )->name( 'logout' );

Route::get( 'logs', array( \Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index' ) );
