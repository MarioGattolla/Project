<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

/** @var Payment[] $payments */
class PaymentController extends Controller
{
    public function show(Payment $payment): View
    {
        $this->authorize('view', $payment);

        return view('admin.payments.show', [
            'payment' => $payment,
        ]);
    }

    public function index(): View
    {
        $this->authorize('viewAny', Payment::class);


        $payments = Payment::all();

        return view('admin.payments.index', [
            'payments' => $payments,
        ]);

    }

    public function edit(Payment $payment): View
    {
        $this->authorize('update', $payment);

        return view('admin.payments.edit', [
            'payment' => $payment,
            'available_users' => User::pluck('surname', 'id'),

        ]);

    }

    public function update(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);


        $this->validate($request, [

        ]);

        $payment->fill($request->all());

        $payment->save();

        return redirect()->route('payments.show', $payment)->with('success', 'Payment successfully modified!!');
    }

    public function create(): View
    {
        $this->authorize('create', Payment::class);


        return view('admin.payments.create', [
            'available_users' => User::pluck('surname', 'id'),

        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Payment::class);

        $this->validate($request, [
            'user_id'=>'required',
            'quote'=>'required',
            'date'=>'required|date',
        ]);

        Payment::create($request->all());


        return redirect()->route('payments.index')->with('success', 'Payment successfully created!!');
    }

    public function destroy(Payment $payment)
    {
        $this->authorize('delete', $payment);

        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'payment successfully deleted!!');
    }

}
