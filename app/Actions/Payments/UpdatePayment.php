<?php

namespace App\Actions\Payments;

use App\Models\Payment;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Http\Request;

class UpdatePayment
{
    use ActsAsAction;

    public function handle(Request $request, Payment $payment): bool
    {
        $payment->fill($request->all());

       return $payment->save();
    }

}
