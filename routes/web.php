<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::prefix('admin')->middleware('auth')->group(function () {
//    Route::get('/users', [UserController::class, 'list'])->name('users.list');
//    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
//    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('services', ServiceController::class );
});


require __DIR__ . '/auth.php';
