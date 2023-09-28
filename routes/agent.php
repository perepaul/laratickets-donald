<?php

use App\Http\Controllers\TicketController;
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
    return view('tickets.index');
})->name('agents.dashboard');


Route::prefix('tickets')->as('tickets.')->group(function () {
    Route::patch('/{ticket}/close', [TicketController::class, 'close'])->name('close');
    Route::delete('/{ticket}/delete', [TicketController::class, 'destroy'])->name('destroy');
});


