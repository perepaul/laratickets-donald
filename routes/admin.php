<?php

use App\Http\Controllers\AgentsController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('admin.dashboard');


Route::prefix('agents')->as('agents.')->group(function () {
    Route::get('/index', [AgentsController::class, 'index'])->name('index');
    Route::get('/create', [AgentsController::class, 'create'])->name('create');
    Route::post('/store', [AgentsController::class, 'store'])->name('store');
    Route::get('/{agent}/edit', [AgentsController::class, 'edit'])->name('edit');
    Route::put('/{agent}/update', [AgentsController::class, 'update'])->name('update');
    Route::put('/{agent}/update-password', [AgentsController::class, 'updatePassword'])->name('update.password');
    Route::delete('/{agent}/delete', [AgentsController::class, 'destroy'])->name('destroy');
});


