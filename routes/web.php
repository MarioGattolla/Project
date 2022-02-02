<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\old\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CoachController;

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

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('payments', PaymentController::class);

});
Route::get('/admin/users/{user}/beacoach', [UserController::class, 'beacoach'])->middleware(['auth'])->name('beacoach');
Route::put('/admin/users/{user}/beacoach', [UserController::class, 'beacoachUpdate'])->middleware(['auth'])->name('beacoachUpdate');


require __DIR__ . '/auth.php';
