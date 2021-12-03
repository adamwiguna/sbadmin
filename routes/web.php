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
});

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/admin', function () {
        return view('admin.dashboard.index');
    })->name('admin');

    Route::get('/admin/opd/', function () {
        return view('admin.opd');
    });

    Route::get('/admin/bidang-bagian/', function () {
        return view('admin.bidang-bagian');
    });
    
    // Route::get('/admin/user/', [UserController::class, 'index']);

    Route::resource('/admin/user/', UserController::class);
});





