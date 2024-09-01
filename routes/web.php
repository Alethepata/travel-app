<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\StageController;

use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\CuriosityController;
use App\Http\Controllers\Admin\NoteController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])
->prefix('admin')
->name('admin.')
->group(function () {
    Route::resource('days', DayController::class);
    Route::resource('stages', StageController::class);
    Route::resource('images', ImageController::class);
    Route::resource('curiosities', CuriosityController::class);
    Route::resource('notes', NoteController::class);
});

require __DIR__.'/auth.php';
