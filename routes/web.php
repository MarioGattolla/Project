<?php

use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PaymentReminderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
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

Route::get('/test', function () {

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class)->except('show');
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('payments', PaymentController::class);
    Route::post('payments/send_payment_reminder_emails', [PaymentReminderController::class, 'send_emails'])->name('payments.reminder.send-emails');

});
Route::get('/admin/users/{user}/beacoach', [UserController::class, 'be_a_coach'])->middleware(['auth'])->name('beacoach');
Route::put('/admin/users/{user}/beacoach', [UserController::class, 'be_a_coach_update'])->middleware(['auth'])->name('beacoach.update');


require __DIR__ . '/auth.php';
