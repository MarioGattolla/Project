<?php

use App\Models\User;

/** @var User $user */
?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create a new Payment:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12">
        <x-body-div>
            <x-div-box>

                    <form method="POST" action="{{route('payments.index', $user)}}">
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">

                        <x-users.form.label for="user_id" class="text-xl">{{$user->name}} {{$user->surname}} , create a new Payment</x-users.form.label>

                        <x-users.form.label for="quote" class="text-lg">Insert the Payment Quote</x-users.form.label>
                        <x-users.form.imput id="quote" name="quote" type="number"/>

                        <x-users.form.label for="date" class="text-lg">Select the Payment Date</x-users.form.label>
                        <input type="date" id="date" name="date" value="{{today()->format('Y-m-d')}}" min="{{today()}}">

                        <x-users.form.submit type="submit" name="submit" value="Submit" class="ml-12"/>
                    </x-div-box>
                </form>

            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
