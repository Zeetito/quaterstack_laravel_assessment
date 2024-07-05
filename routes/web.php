<?php

use App\Http\Controllers\ProposalController;
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

Route::get('/', [ProposalController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::get('/proposal/create', [ProposalController::class,'create'])->middleware(['auth'])->name('proposal.create');
Route::get('/proposal/{proposal}/edit', [ProposalController::class,'edit'])->middleware(['auth'])->name('proposal.edit');
Route::delete('/proposal/{proposal}/destroy', [ProposalController::class,'destroy'])->middleware(['auth'])->name('proposal.destroy');
Route::get('/proposal/print/{proposal}', [ProposalController::class,'pdf_print'])->middleware(['auth'])->name('proposal.print');

Route::get('/proposal/send/{proposal}', [ProposalController::class,'send'])->middleware(['auth'])->name('proposal.send');

Route::get('/proposal/view_printable/{proposal}', [ProposalController::class,'view_printable'])->middleware(['auth'])->name('proposal.view_printable');


require __DIR__.'/auth.php';
