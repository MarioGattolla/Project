<?php

namespace App\Actions\Payments;

use App\Models\Payment;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateNewPayment
{
    use ActsAsAction;

    public function handle(Request $request): Model|Payment
    {
        return Payment::create($request->all());
    }

}
