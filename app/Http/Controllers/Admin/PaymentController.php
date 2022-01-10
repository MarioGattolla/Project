<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Models\Payment;
use App\Models\Role;
use App\Models\User;

/** @var Payment[] $payments */

use Illuminate\Http\Request;
use Illuminate\View\View;
use function React\Promise\all;

class PaymentController extends Controller
{
    public function show(Payment $payment): View
    {
        return view('admin.payments.show', [
            'payment' => $payment,
        ]);
    }

    public function index(): View
    {
        $payments = Payment::all();

        return view('admin.payments.index', [
            'payments' => $payments,
        ]);

    }

    public function edit(Payment $payment): View
    {
        return view('admin.payments.edit', [
            'payment' => $payment,
            'available_users' => User::pluck('name', 'id'),
            'available_inscriptions' => Inscription::pluck('id'),
        ]);

    }

    public function update(Request $request, Payment $payment)
    {
        $this->validate($request, [

        ]);

        $payment->fill($request->all());

        $payment->save();

        return redirect()->route('payments.show', $payment)->with('success', 'Pagamento modificato correttamente!!');
    }

    public function create(): View
    {
        return view('admin.payments.create', [
            'available_users' => User::pluck('name', 'id'),
            'available_inscriptions' => Inscription::pluck('id'),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [

        ]);

        Payment::create($request->all());
        return redirect()->route('payments.index')->with('success', 'Pagamento creato correttamente!!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pagamento eliminato correttamente!!');
    }

}
