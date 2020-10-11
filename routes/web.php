<?php

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



Route::post('visitor', [\App\Http\Controllers\VisitorController::class, 'store'])->name('visitor.store');

Route::group(
    [
        'middleware' => ['auth:sanctum', 'verified'],
        'prefix' => 'dashboard',
        'as' => 'dashboard.'
    ],
    function () {
        Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');

        Route::resources(
            [
                'venue' => \App\Http\Controllers\VenueController::class,
                'visitor' => \App\Http\Controllers\VisitorController::class,
                'user' => \App\Http\Controllers\UserController::class,
            ]
        );

        Route::post('logo', [\App\Http\Controllers\DashboardController::class, 'uploadLogo'])->name('logo.upload');
        Route::delete('logo', [\App\Http\Controllers\DashboardController::class, 'deleteLogo'])->name('logo.delete');
    }
);

Route::get('/', [\App\Http\Controllers\PageController::class, 'index']);
// Below has to be after dashboard
Route::get('/{venue}', [\App\Http\Controllers\PageController::class, 'index'])->name('index.venue');
