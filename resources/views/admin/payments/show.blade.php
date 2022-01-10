<?php
/** @var \App\Models\Payment $payment */
?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            <x-div-box class="border-2 border-gray-200 rounded">
                <x-users.form.label for="" class="text-lg">Current Payment</x-users.form.label>

                <x-users.form.label for="user_id" class="text-lg">User Name : {{$payment->user->name}}</x-users.form.label>

                <x-users.form.label for="date" class="text-lg">Payment Date : {{$payment->date}}</x-users.form.label>

                <x-users.form.label for="quote" class="text-lg">Payment Quote : {{$payment->quote}}</x-users.form.label>

                <x-button class="mb-3"><a href="{{route('payments.edit', $payment)}}">Modifica</a></x-button>
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>Delete</x-button>
                </form>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
