<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Payments\CreateNewPayment;
use App\Actions\Payments\DeletePayment;
use App\Actions\Payments\UpdatePayment;
use App\Http\Controllers\Controller;
use App\Models\Payment;
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

        return view('admin.payments.index');

    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Payment $payment): View
    {
        $this->authorize('update', $payment);

        return view('admin.payments.edit', [
            'payment' => $payment,
        ]);

    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $this->authorize('update', $payment);

        UpdatePayment::make()->handle($request, $payment);

        return redirect()->route('payments.show', $payment)->with('success', 'Payment successfully modified!!');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', Payment::class);

        return view('admin.payments.create');
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Payment::class);

        $this->validate($request, [
            'user_id' => 'required',
            'quote' => 'required',
            'date' => 'required|date',
        ]);

        CreateNewPayment::make()->handle($request);

        return redirect()->route('payments.index')->with('success', 'Payment successfully created!!');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $this->authorize('delete', $payment);

        DeletePayment::make()->handle($payment);

        return redirect()->route('payments.index')->with('success', 'Payment successfully deleted!!');
    }

}
