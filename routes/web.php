<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;
// use HeadlessChromium\BrowserFactory;
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

Route::get('/', fn() => redirect()->route('login'));

Route::get('/indigency/{params}', [DocumentController::class, 'indigency'])->name('indigency');
Route::get('/residency/{params}', [DocumentController::class, 'residency'])->name('residency');
Route::get('/clearance/{params}', [DocumentController::class, 'clearance'])->name('clearance');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/pdf', [PdfController::class, 'printPdf'])->name('pdf.print');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::put('/users/{id}/undo', [UserController::class, 'undo'])->name('users.undo');
    Route::resource('users', UserController::class);

    Route::put('/residents/{id}/undo', [ResidentController::class, 'undo'])->name('residents.undo');
    Route::resource('residents', ResidentController::class);

    Route::get('/activity-logs', fn() => view('tables.activity-log'))->name('activity-logs');
});
