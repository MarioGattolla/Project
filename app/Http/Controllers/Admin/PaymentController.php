<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/** @var Payment[] $payments */
class PaymentController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function show(Payment $payment): View
    {
        $this->authorize('view', $payment);

        return view('admin.payments.show', [
            'payment' => $payment,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('viewAny', Payment::class);


        $payments = Payment::all();

        return view('admin.payments.index', [
            'payments' => $payments,
        ]);

    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Payment $payment): View
    {
        $this->authorize('update', $payment);

        return view('admin.payments.edit', [
            'payment' => $payment,
            'available_users' => User::pluck('surname', 'id'),

        ]);

    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $this->authorize('update', $payment);


        $this->validate($request, [

        ]);

        $payment->fill($request->all());

        $payment->save();

        return redirect()->route('payments.show', $payment)->with('success', 'Payment successfully modified!!');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', Payment::class);


        return view('admin.payments.create', [
            'available_users' => User::pluck('surname', 'id'),

        ]);
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
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

    /**
     * @throws AuthorizationException
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $this->authorize('delete', $payment);

        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'payment successfully deleted!!');
    }

}
