<?php
/** @var Payment $payment */
/** @var User $user */
use App\Models\Payment;
use App\Models\User;

?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12">
        <x-body-div>
            <x-div-box class="border-2 border-gray-200 rounded m-3">
                <form method="POST" action="/admin/users/{{$user->id}}/payments/{{$payment->id}}" class="bg-white p-5">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="" class="text-lg bg-blue-100 rounded-md">Edit the current Payment
                    </x-users.form.label>

                    <div class="bg-gray-50">
                        <x-users.form.label for="name" class="text-lg">User  : {{$payment->user->name}} {{$payment->user->surname}}</x-users.form.label>

                        <x-users.form.label for="quote" id="quote" class="text-lg">Payment Quote :</x-users.form.label>
                        <input type="number" id="quote" name="quote" class="ml-3" value="{{old('quote', $payment->quote)}}">

                        <x-users.form.label for="date" class="text-lg">Payment Date :</x-users.form.label>
                        <input class="ml-3" type="date" id="date" name="date" min="{{today()}}" value="{{old('date', $payment->date->format('Y-m-d'))}}">


                        <x-users.form.submit type="submit" class="mt-3 ml-3" value="Submit" name="submit"/>
                    </div>


                </form>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
