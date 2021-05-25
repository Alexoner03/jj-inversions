<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/calculadora')->group(function () {
    Route::get('/',[CalculatorController::class, 'showCalculator'])->name('calculadora.index');
    Route::post('/',[CalculatorController::class, 'storeComunication'])->name('calculadora.store');
});

Route::get('/', [AuthController::class,'index'])->name('index');
// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//     Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
// });

//EMAIL VERIFICATION ROUTES
Route::prefix('/email')->group(function () {
    Route::get('/verify', [AuthController::class,'VerificationNotice'])->middleware('auth')->name('verification.notice');
    Route::get('/verify/{id}/{hash}', [AuthController::class,'VerificationVerify'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/verification-notification',[AuthController::class,'VerificationNotification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');    
});

//Users routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/investor/mailing', [InvestorController::class,'mailingIndex'])->name('investor.mailing');
    Route::post('/investor/mailing-send', [InvestorController::class,'mailing'])->name('investor.mailsend');
    Route::resource('/investor', InvestorController::class);

    Route::resource('/user', UserController::class)->except(['show']);
    Route::resource('/investment', InvestmentController::class)->only(['store','update','destroy']);
    Route::resource('/lead', LeadController::class)->only(['index','destroy']);
    Route::resource('/calculator', CalculatorController::class)->only(['index','update']);
});

