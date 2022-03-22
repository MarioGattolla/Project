<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessDebtorReminderMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class PaymentReminderController extends Controller
{
//    public function send_emails(): JsonResponse
//    {
//        $users = User::all();
//
//        foreach ($users as $user) {
//            $debit = $user
//                ->subscriptions
//                ->map(fn(Subscription $subscription) => $subscription->services()->sum('price'))
//                ->sum();
//
//            $credit = $user->payments()->sum('quote');
//
//            if ($credit - $debit < 0)
//            {
//
//                $this->dispatch(new ProcessDebtorReminderMail($user));
//            }
//        }
//
//        return response()->json([
//            'ok' => true,
//            'message' => 'email inviate',
//        ]);
//    }

        public function send_debit_reminder_emails(): JsonResponse
        {
            $users = User::all()
                ->filter(fn (User $user) => $user->is_debtor());

            $users->each(function (User $user){
                $this->dispatch(new ProcessDebtorReminderMail($user));
            });

            return response()->json([
            'ok' => true,
            'message' => 'email inviate',
        ]);
        }
}
