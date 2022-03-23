<?php

namespace App\Actions\Payments;

use App\Models\Payment;
use App\Models\User;
use Carbon\CarbonInterface;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateNewPayment
{
    use ActsAsAction;

    public function handle(User $user, float $quote, CarbonInterface $date, ): Model|Payment
    {
       return $user->payments()->create([
           'date' =>  $date,
           'quote' => $quote,
       ]);
    }

}
