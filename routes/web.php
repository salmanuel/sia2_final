<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');
    Route::get('/rooms/create', [RoomsController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomsController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}', [RoomsController::class, 'show'])->name('room.show');
    Route::get('/rooms/edit/{room}', [RoomsController::class , 'edit'])->name('room.edit');
    Route::patch('/rooms/{room}', [RoomsController::class, 'update'])->name('room.update');
    Route::delete('/rooms/{room}', [RoomsController::class, 'destroy'])->name('room.delete');
    Route::get('/rooms/search/{searchKey}', [RoomsController::class, 'search'])->name('room.search');
    Route::get('/rooms/email/{room}',[RoomsController::class,'email']);


    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::post('/admin/email', [AdminController::class, 'sendEmailToAll'])->name('admin.email');

    Route::post('/rooms/toggle/{room}', [RoomsController::class, 'toggleActive'])->name('toggleAvailability');

});
