<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Payments\CreateNewPayment;
use App\Actions\Payments\DeletePayment;
use App\Actions\Payments\UpdatePayment;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Auth;
use Carbon\Carbon;
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
    public function index(User $user = null): View
    {
        return view('admin.payments.index', [
            'user' => $user ?? Auth::user(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function show( Payment $payment): View
    {
        $this->authorize('view', $payment);

        return view('admin.payments.show', [
            'payment' => $payment,
            ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(User $user = null): View
    {
        return view('admin.payments.create', [
            'user' => $user ?? Auth::user(),
        ]);
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'quote' => 'required',
            'date' => 'required|date',
        ]);

        $user = Auth::user();
        $quote = $request->input('quote');
        $date = Carbon::make($request->input('date'));

        CreateNewPayment::run($user, $quote, $date);

        return redirect()->route('payments.index')->with('success', 'Payment successfully created!!');
    }


    /**
     * @throws AuthorizationException
     */
    public function edit( Payment $payment): View
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

        $this->validate($request, [
            'quote' => 'required',
            'date' => 'required|date',
        ]);

        $user = $payment->user ;
        $quote = $request->input('quote');
        $date = Carbon::make($request->input('date'));

        UpdatePayment::run($user, $quote, $date, $payment);

        return redirect()->route('payments.show', $payment)->with('success', 'Payment successfully modified!!');
    }


    /**
     * @throws AuthorizationException
     */
    public function destroy( Payment $payment): RedirectResponse
    {
        $this->authorize('delete', $payment);

        DeletePayment::run($payment);

        return redirect()->route('payments.index')->with('success', 'Payment successfully deleted!!');
    }

}
