<?php

use App\Livewire\Tasks\Index;
use App\Livewire\Tasks\Management\Create;
use App\Livewire\Tasks\Management\Index as ManagementIndex;
use App\Livewire\Tasks\Management\Update;
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

Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', Index::class)->name('index');
    Route::prefix('management')->name('management.')->group(function () {
        Route::get('/', ManagementIndex::class)->name('index');
        Route::get('create', Create::class)->name('create');
        Route::get('update/{slug}', Update::class)->name('update');
    });
})->middleware(['auth']);
