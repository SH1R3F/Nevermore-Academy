<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::redirect('/', '/dashboard', 301);

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');


    /* Manage users */
    Route::get('users', [UserController::class, 'index'])->can('list-user')->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->can('create-user')->name('users.create');
    Route::post('users', [UserController::class, 'store'])->can('create-user')->name('users.store');
    Route::get('users/{user}', [UserController::class, 'edit'])->can('update-user')->name('users.edit');
    Route::patch('users/{user}', [UserController::class, 'update'])->can('update-user')->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->can('delete-user')->name('users.destroy');


    //
});

require __DIR__ . '/auth.php';
