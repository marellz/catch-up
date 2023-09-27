<?php

use App\Http\Controllers\TaskController;
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


Route::get('/', [TaskController::class, 'index'])->name('tasks');

Route::prefix('tasks')->group(function () {
    Route::post('/create', [TaskController::class, 'store'])->name('tasks.create');
    Route::patch('/update/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/destroy/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});



// Route::get('/', function () {
//     return ['Laravel' => app()->version()];
// });

// require __DIR__.'/auth.php';
