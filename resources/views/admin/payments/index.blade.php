@php
    use App\Models\Inscription;
    /** @var Payment[] $payments */
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Payments:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            @foreach($payments as $payment)
                <x-div-box class="mb-5 border-2 border-gray-200 rounded ">
                    <x-div-box for="user_id">Payment User : {{$payment->user->name}}</x-div-box>
                    <x-div-box for="quote">Payment Quote : {{$payment->quote}}</x-div-box>
                    <x-div-box for="date">Payment Date : {{$payment->date}}</x-div-box>
                    <x-button type="button"><a href="{{route('payments.show',$payment)}}"/>Modifica</x-button>
                </x-div-box>
            @endforeach
        </x-body-div>
    </div>

</x-app-layout>
