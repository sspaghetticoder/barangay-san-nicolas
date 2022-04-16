<?php

use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Dashboard;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::put('/users/{id}/undo', [UserController::class, 'undo'])->name('users.undo');
    Route::resource('users', UserController::class);

    Route::put('/residents/{id}/undo', [ResidentController::class, 'undo'])->name('residents.undo');
    Route::resource('residents', ResidentController::class);

    Route::get('/activity-logs', fn() => view('tables.activity-log'))->name('activity-logs');
});
