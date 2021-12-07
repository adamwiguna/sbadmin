<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);



Route::middleware(['auth'])->group(function () {

    Route::post('logout', [LoginController::class, 'logout']);

    Route::middleware('is_admin')
           ->prefix('admin')
           ->name('admin.')
           ->group(function () {

        Route::get('dashboard', [App\http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('opd', App\http\Controllers\Admin\OpdController::class);
    
        Route::get('bidang-bagian', function () {
            return view('admin.bidang-bagian');
        });
        
    });

});





