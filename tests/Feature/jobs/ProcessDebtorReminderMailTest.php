<?php

use App\Jobs\ProcessDebtorReminderMail;
use App\Mail\PaymentReminderMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('Reminder Mail Job can send email', closure: function () {

    Mail::fake();

    \App\Models\Service::factory()->create();

    $user = User::factory()->withRandomSubscriptions()->create();

    $response = app(\App\Http\Controllers\Admin\PaymentReminderController::class)->send_debit_reminder_emails();

    Mail::assertSent(PaymentReminderMail::class, function (PaymentReminderMail $mail) use ($user) {
        return $mail->user->email == $user->email;
    });
});
