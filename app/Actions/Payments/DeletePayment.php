<?php

namespace App\Actions\Payments;

use App\Models\Payment;
use DefStudio\Actions\Concerns\ActsAsAction;

class DeletePayment
{
    use ActsAsAction;

    public function handle(Payment $payment): ?bool
    {
        return $payment->delete();
    }

}
