<?php

use App\Mail\PaymentReminderMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('send_emails can send email',function (){

    $user = User::factory()->make();

    Mail::fake()->to($user)->send(new PaymentReminderMail());

   Mail::assertSent(PaymentReminderMail::class);
});
