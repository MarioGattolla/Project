<?php

use App\Enums\Role;
use App\Http\Controllers\Admin\PaymentReminderController;
use App\Jobs\ProcessDebtorReminderMail;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('send_emails can queue mail', function () {
    Bus::fake();

    Service::factory()->count(3)->create();

    $good_user = User::factory()
        ->role(Role::user)
        ->withRandomPayments()
        ->create();

    $debtor = User::factory()
        ->role(Role::user)
        ->withRandomSubscriptions()
        ->create();

    app(PaymentReminderController::class)->send_debit_reminder_emails();

    Bus::assertDispatched(ProcessDebtorReminderMail::class, function (ProcessDebtorReminderMail $mail) use ($debtor) {
        return $mail->user->id == $debtor->id;
    });
});

