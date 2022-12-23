<?php

use App\Http\Controllers\EpresenceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UnauthorizationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('login', UnauthorizationController::class)->name('login');
Route::post('login', LoginController::class)->name('login.process');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile', UserController::class)->name('profile');

    Route::prefix('epresences')->group(function(){
        Route::get('/', [EpresenceController::class, 'index'])->name('epresance.index');
        Route::post('store', [EpresenceController::class, 'store'])->name('epresance.store');
        Route::post('approve/{id}', [EpresenceController::class, 'approve'])->name('epresance.update');
    });
});
