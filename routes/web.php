<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\old\RoleController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('services', ServiceController::class );
    Route::resource('subscriptions', SubscriptionController::class );
    Route::resource('payments',PaymentController::class);
    Route::resource('coaches', CoachController::class);
});


require __DIR__ . '/auth.php';
