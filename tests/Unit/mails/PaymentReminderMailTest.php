<?php

test('build function return mailable',function (){

    $response = app(\App\Mail\PaymentReminderMail::class)->build();

    expect($response)->toBeInstanceOf(\Illuminate\Mail\Mailable::class);
});
