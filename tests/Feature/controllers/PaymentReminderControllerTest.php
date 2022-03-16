<?php

use App\Enums\Role;
use App\Http\Controllers\Admin\PaymentReminderController;
use App\Jobs\ProcessDebtorReminderMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

//test('send_emails can send email to queue', function () {
//    Bus::fake();
//
//    $user = User::factory()->role(Role::admin)->create();
//
//    app(PaymentReminderController::class)->send_emails();
//
//    Bus::assertDispatchedSync(ProcessDebtorReminderMail::class);
//});

