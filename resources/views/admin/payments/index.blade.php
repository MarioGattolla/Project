@php
    use App\Models\Payment;
    /** @var Payment[] $payments */
        $payments = Payment::orderBy('user_id')->paginate();

@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Payments:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12">

        <x-body-div class="m-3 p-3">
            <div class="m-3 p-3">
                <a href="{{route('payments.create')}}" class="text-xl m-3 p-3  ">Create a new Payment</a>
            </div>
            <div class="grid xl:grid-cols-6 md:grid-cols-4 sm:grid-cols-2 gap-4 m-3 p-3 ">
                @foreach($payments as $payment)
                    <div class="mb-5 border-2 border-gray-200 rounded col-span-2 ">
                        <div class="bg-blue-100 rounded-md p-2 m-2">Payment User
                            : {{$payment->user->name}} {{$payment->user->surname }}</div>
                        <div class="m-2 p-2 bg-gray-50">
                            <div>Payment Quote : €{{$payment->quote}}</div>
                            <div>Payment Date : {{$payment->date->format('Y-m-d')}}</div>
                        </div>
                        <x-button class="m-3" type="button" href="{{route('payments.show',$payment)}}">Show
                        </x-button>
                    </div>
                @endforeach
            </div>
            {{$payments->links()}}
        </x-body-div>
    </div>

</x-app-layout>
