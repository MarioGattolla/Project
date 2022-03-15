<?php

use App\Http\Controllers\Admin\PaymentReminderController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('send_emails return json', function (){
    $response = app(PaymentReminderController::class)->send_emails();
    expect($response)->toHaveJson([
        'ok' => true,
        'message' => 'email inviate',]);
});

