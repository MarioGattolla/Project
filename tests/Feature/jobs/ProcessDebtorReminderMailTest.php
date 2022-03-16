<?php

use App\Jobs\ProcessDebtorReminderMail;
use App\Mail\PaymentReminderMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

//test('Reminder Mail Job can send email', function () {
//
//
//    $response = app(ProcessDebtorReminderMail::class);
//
//    Mail::assertSent($response);
//});
