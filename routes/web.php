<?php

use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\DashboardController;
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
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class)->except('show');
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('payments', PaymentController::class);

});
Route::get('/admin/users/{user}/beacoach', [UserController::class, 'beacoach'])->middleware(['auth'])->name('beacoach');
Route::put('/admin/users/{user}/beacoach', [UserController::class, 'beacoachUpdate'])->middleware(['auth'])->name('beacoachUpdate');


require __DIR__ . '/auth.php';
