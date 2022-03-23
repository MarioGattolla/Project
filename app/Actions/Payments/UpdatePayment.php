<?php

namespace App\Actions\Payments;

use App\Models\Payment;
use App\Models\User;
use Carbon\CarbonInterface;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Http\Request;

class UpdatePayment
{
    use ActsAsAction;

    public function handle(User $user, float $quote, CarbonInterface $date, Payment $payment): bool
    {
      $payment->update([
          'quote' =>$quote,
          'date' => $date,
          'user_id'=> $user->id,
      ]);

       return $payment->save();
    }

}
