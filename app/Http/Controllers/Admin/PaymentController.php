<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Payments\CreateNewPayment;
use App\Actions\Payments\DeletePayment;
use App\Actions\Payments\UpdatePayment;
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
    public function show(User $user, Payment $payment): View
    {
        $this->authorize('view', $payment);

        return view('admin.payments.show', [
            'payment' => $payment,
            'user' => $user,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function index(User $user): View
    {
        $this->authorize('viewAny', Payment::class);

        return view('admin.payments.index', [
            'user' => $user,
        ]);

    }

    /**
     * @throws AuthorizationException
     */
    public function edit(User $user, Payment $payment): View
    {
        $this->authorize('update', $payment);

        return view('admin.payments.edit', [
            'payment' => $payment,
            'user' => $user,
        ]);

    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Request $request, User $user, Payment $payment): RedirectResponse
    {
        $this->authorize('update', $payment);

        UpdatePayment::make()->handle($request, $payment);

        return redirect()->route('payments.show', [$user, $payment])->with('success', 'Payment successfully modified!!');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(User $user): View
    {
        $this->authorize('create', Payment::class);

        return view('admin.payments.create', [
            'user' => $user,
        ]);
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function store(Request $request , User $user): RedirectResponse
    {
        $this->authorize('create', Payment::class);

        $this->validate($request, [
            'user_id' => 'required',
            'quote' => 'required',
            'date' => 'required|date',
        ]);

        CreateNewPayment::make()->handle($request);

        return redirect()->route('payments.index', $user)->with('success', 'Payment successfully created!!');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(User $user, Payment $payment): RedirectResponse
    {
        $this->authorize('delete', $payment);

        DeletePayment::make()->handle($payment);

        return redirect()->route('payments.index', $user)->with('success', 'Payment successfully deleted!!');
    }

}
