<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    
    Route::prefix('/dashboard')->name('dash.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks');
    });

    # POST requests
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::post('/create', [TaskController::class, 'store'])->name('create');
        Route::patch('/update/{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('/destroy/{task}', [TaskController::class, 'destroy'])->name('destroy');
    });
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');




// Route::get('/', function () {
//     return ['Laravel' => app()->version()];
// });

require __DIR__ . '/auth.php';
