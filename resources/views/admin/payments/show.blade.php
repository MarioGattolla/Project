<?php
/** @var Payment $payment */

use App\Models\Payment;

?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12">
        <x-body-div>
            <x-div-box class="p-3 m-3">
                <div class="grid grid-cols-3">
                    <div class="bg-blue-100 col-span-1 p-3">
                        <x-users.form.label for="" class="text-lg">Current Payment</x-users.form.label>

                        <x-users.form.label for="name" class="text-lg">User Name
                            : {{$payment->user->name}}</x-users.form.label>

                        <x-users.form.label for="surname" class="text-lg">User Surname
                            : {{$payment->user->surname}}</x-users.form.label>
                    </div>
                    <div class="bg-gray-50 col-span-2 p-3">

                        <x-users.form.label for="quote" class="text-lg">Payment Quote
                            : {{$payment->quote}}</x-users.form.label>

                        <x-users.form.label for="date" class="text-lg">Payment Date
                            : {{$payment->date->format('Y-m-d')}}</x-users.form.label>

                    </div>
                </div>
                <x-button class="mt-3 mb-3"><a href="{{route('payments.edit', $payment)}}">Edit</a></x-button>
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>Delete</x-button>
                </form>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
