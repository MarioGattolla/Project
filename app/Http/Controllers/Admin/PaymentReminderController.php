<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PaymentReminderMail;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentReminderController extends Controller
{
    public function send_emails(): JsonResponse
    {
        $users = User::all();

        foreach ($users as $user) {
            $debit = $user
                ->subscriptions
                ->map(fn(Subscription $subscription) => $subscription->services()->sum('price'))
                ->sum();

            $credit = $user->payments()->sum('quote');

            if ($credit - $debit < 0)
            {
                Mail::to($user)->queue(new PaymentReminderMail($user));
            }
        }



        return response()->json([
            'ok' => true,
            'message' => 'email inviate',
        ]);
    }
}
