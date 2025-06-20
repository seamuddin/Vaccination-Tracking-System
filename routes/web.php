<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontendController;
use App\Modules\Dashboard\Http\Controllers\DashboardController;
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
    Route::post('login-check', [LoginController::class, 'logincheck'])->name('login.check');
// });

Route::get('/', [FrontendController::class, 'home'])->name('home');
//Route::get('/home', [FrontendController::class, 'frontend'])->name('homes');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/event_page', [FrontendController::class, 'eventPage'])->name('event_page');
Route::get('/event_details/{id}', [FrontendController::class, 'eventDetails'])->name('event_details');
Route::get('/committee_page', [FrontendController::class, 'committeePage'])->name('committee_page');
Route::get('/committees/{committee_type_id}', [FrontendController::class, 'committeePageByType'])->name('committee_by_type');


Route::get('/gurdian_portfolio', [FrontendController::class, 'gurdianPortfolio'])->name('gurdianPortfolio');



Route::get( 'logout', array( LoginController::class, 'logout' ) )->name( 'logout' );



Route::get( 'logs', array( \Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index' ) );
